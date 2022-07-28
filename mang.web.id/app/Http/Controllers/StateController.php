<?php
namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\state\St_Kota;
use App\Models\state\St_Kecamatan;
use App\Models\state\St_Kelurahan;

class StateController extends BaseController{

	public function get_kota(Request $request){
		$param = $request->all();
        $search = [];
		if(count($param) > 0){
            foreach($param as $key => $value){
                if(!empty($value)){
                    if ($key == 'kota_provinsi_id') {
                        array_push($search, [$key, '=', $value]);
                    } else {
                        array_push($search, [$key, 'LIKE', '%'.$value.'%']);
                    }
                }
            }
        }

        $data = St_Kota::where($search)
        		->orderBy('kota_name', 'ASC')
        		->get(); 
      
		return response()->json($data,200);
	}

	public function get_kecamatan(Request $request){
		$param = $request->all();
        $search = [];
		if(count($param) > 0){
            foreach($param as $key => $value){
                if(!empty($value)){
                    if ($key == 'kecamatan_kota_id') {
                        array_push($search, [$key, '=', $value]);
                    } else {
                        array_push($search, [$key, 'LIKE', '%'.$value.'%']);
                    }
                }
            }
        }

        $data = St_Kecamatan::where($search)
        		->orderBy('kecamatan_name', 'ASC')
        		->get(); 
      
		return response()->json($data,200);
	}

	public function get_kelurahan(Request $request){
		$param = $request->all();
        $search = [];
		if(count($param) > 0){
            foreach($param as $key => $value){
                if(!empty($value)){
                    if ($key == 'kelurahan_kec_id') {
                        array_push($search, [$key, '=', $value]);
                    } else {
                        array_push($search, [$key, 'LIKE', '%'.$value.'%']);
                    }
                }
            }
        }

        $data = St_Kelurahan::where($search)
        		->orderBy('kelurahan_name', 'ASC')
        		->get(); 
      
		return response()->json($data,200);

	}
	

}
?>