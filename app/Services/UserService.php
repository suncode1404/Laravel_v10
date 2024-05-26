<?php

namespace App\Services;

use App\Services\Interfaces\UserServiceInterface;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserService
 * @package App\Services
 */
class UserService implements UserServiceInterface
{
    protected $userRepository;
    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function paginate() {
        $users = $this->userRepository->getAllPaginate();
        return $users;
    }
    public function create($request) {
        DB::beginTransaction();
        try {
            $payload = $request->except(['_token','send','re_password']);
            $carbonDate = Carbon::createFromFormat('Y-m-d',$payload['birthday']);
            $payload['birthday'] = $carbonDate->format('Y-m-d H:i:s');
            $payload['password'] = Hash::make($payload['password']);
            $user = $this->userRepository->create($payload);
            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
            echo $th->getMessage();die();
            // return false;
        }
    }
}
