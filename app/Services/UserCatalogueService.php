<?php

namespace App\Services;

use App\Services\Interfaces\UserCatalogueServiceInterface;
use App\Repositories\Interfaces\UserCatalogueRepositoryInterface as UserCatalogueRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserCatalogueService
 * @package App\Services
 */
class UserCatalogueService implements UserCatalogueServiceInterface
{
    protected $userCatalogueRepository;
    public function __construct(UserCatalogueRepository $userCatalogueRepository)
    {
        $this->userCatalogueRepository = $userCatalogueRepository;
    }

    public function paginate($request)
    {
        $condition['keyword'] = addslashes($request->input('keyword'));
        $condition['publish'] = $request->integer('publish');
        $perPage = $request->integer('perpage');
        $userCatalogues  = $this->userCatalogueRepository->pagination($this->select(), $condition, [], ['path' => 'user/catalogue/index'], $perPage, ['users']);
        return $userCatalogues;
    }
    public function create($request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except(['_token', 'send']);
            $user = $this->userCatalogueRepository->create($payload);
            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
            echo $th->getMessage();
            die();
            // return false;
        }
    }
    public function update($id, $request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except(['_token', 'send']);
            $user = $this->userCatalogueRepository->update($id, $payload);
            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
            echo $th->getMessage();
            die();
            // return false;
        }
    }
    public function updateStatus($post = [])
    {
        DB::beginTransaction();

        try {
            $payload = [
                $post['field'] => (($post['value'] == 1) ? 2 : 1)
            ];
            $user = $this->userCatalogueRepository->update($post['modelId'], $payload);
            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
            echo $th->getMessage();
            die();
            // return false;
        }
    }
    public function updateStatusAll($post = [])
    {
        DB::beginTransaction();

        try {
            $payload = [
                $post['field'] => $post['value']
            ];
            $flag = $this->userCatalogueRepository->updateByWhereIn('id', $post['id'], $payload);
            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
            echo $th->getMessage();
            die();
            // return false;
        }
    }
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $user = $this->userCatalogueRepository->delete($id);
            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
            echo $th->getMessage();
            die();
            // return false;
        }
    }
    private function convertBirthdayDate($birthday = '')
    {
        $carbonDate = Carbon::createFromFormat('Y-m-d', $birthday);
        $birthday = $carbonDate->format('Y-m-d H:i:s');
        return $birthday;
    }
    private function select()
    {
        return [
            'id',
            'name',
            'description',
            'publish'
        ];
    }
}
