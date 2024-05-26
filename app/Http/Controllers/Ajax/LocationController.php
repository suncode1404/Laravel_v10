<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\DistrictRepositoryInterface as DistrictRepository;
use App\Repositories\Interfaces\ProvinceRepositoryInterface as ProvinceRepository;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    protected $DistrictRepository;
    protected $ProvinceRepository;
    public function __construct(DistrictRepository $DistrictRepository,ProvinceRepository $ProvinceRepository)
    {
        $this->DistrictRepository = $DistrictRepository;
        $this->ProvinceRepository = $ProvinceRepository;
    }

    public function getLocation(Request $request) {
        // $province_id = $request->input('province_id');
        // $districts = $this->DistrictRepository->findDistricByProvinceId( $province_id);

        $get = $request->input();
        $html = '';

        if($get['target'] == 'districts') {
            $province = $this->ProvinceRepository->findById($get['data']['location_id'], ['code','name'], ['districts']);
            $html = $this->renderHtml($province->districts);
        }else if($get['target'] == 'wards') {
            $district = $this->DistrictRepository->findById($get['data']['location_id'], ['code','name'], ['wards']);
            $html = $this->renderHtml($district->wards,'Chọn Phường/Xã');
        }
        
        $response = [
            'html' =>$html
        ];
        return response()->json($response);
    }

    public function renderHtml($districts,$root ='Chọn Quận/huyện') {
        $html = '<option value="0">'.$root.'</option> ';
        foreach ($districts as $district) {
            $html .= '<option value="'.$district->code.'">'.$district->name.'</option>';
        }
        return $html;
    }   

}
