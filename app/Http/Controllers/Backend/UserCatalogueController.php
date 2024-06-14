<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\StoreUserCatalogueRequest;
use App\Repositories\Interfaces\UserCatalogueRepositoryInterface as UserCatalogueRepository;
use App\Services\Interfaces\UserCatalogueServiceInterface as UserCatalogueService;


class UserCatalogueController extends Controller
{
    protected $userCatalogueService;
    protected $userCatalogueRepository;
    public function __construct(
        UserCatalogueService $userCatalogueService,
        UserCatalogueRepository $userCatalogueRepository
    ) {
        $this->userCatalogueService = $userCatalogueService;
        $this->userCatalogueRepository = $userCatalogueRepository;
    }
    public function index(Request $request)
    {
        $userCatalogues = $this->userCatalogueService->paginate($request);

        $config = [
            'js' => [
                'backend/js/plugins/switchery/switchery.js',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js'
            ],
            'css' => [
                'backend/css/plugins/switchery/switchery.css',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'
            ]
        ];
        $config['seo'] = config('apps.usercatalogue');
        $template = 'backend.user.catalogue.index';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'userCatalogues',
        ));
    }

    public function create()
    {
        $template = 'backend.user.catalogue.store';
        $config['seo'] = config('apps.usercatalogue');
        $config['method'] = 'create';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
        ));
    }
    public function store(StoreUserCatalogueRequest $request)
    {
        if ($this->userCatalogueService->create($request)) {
            return redirect()->route('user.catalogue.index')->with('success', 'Thêm mới bản ghi thành công');
        }
        return redirect()->route('user.catalogue.index')->with('error', 'Thêm mới bản ghi không thành công. Háy thử lại');
    }
    public function edit($id)
    {
        $userCatalogues = $this->userCatalogueRepository->findById($id);
        $template = 'backend.user.catalogue.store';
        $config['seo'] = config('apps.usercatalogue');
        $config['method'] = 'edit';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'userCatalogues'
        ));
    }

    public function update($id, StoreUserCatalogueRequest $request)
    {
        if ($this->userCatalogueService->update($id, $request)) {
            return redirect()->route('user.catalogue.index')->with('success', 'Cập nhập bản ghi thành công');
        }
        return redirect()->route('user.catalogue.index')->with('error', 'Cập nhập bản ghi không thành công. Hãy thử lại');
    }
    public function delete($id)
    {
        $userCatalogues = $this->userCatalogueRepository->findById($id);
        $template = 'backend.user.catalogue.delete';
        $config['seo'] = config('apps.usercatalogue');
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'userCatalogues'
        ));
    }
    public function destroy($id)
    {
        if ($this->userCatalogueService->destroy($id)) {
            return redirect()->route('user.catalogue.index')->with('success', 'Xóa bản ghi thành công');
        }
        return redirect()->route('user.catalogue.index')->with('error', 'Xóa bản ghi không thành công. Hãy thử lại');
    }
}
