<?php
namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Pr_Kategori;
use App\Models\Pr_Produk;
use App\Models\St_Slide;
use App\Models\St_Setting;

use Illuminate\Http\Request;

class WelcomeController extends BaseController{

	public function index(){
        
		$kategori = Pr_Kategori::get();
        $slide = St_Slide::get();
		$param = array(
			"kategori" => $kategori,
            "slide" => $slide
		);
		return view("pages/index")->with($param);
	}

	public function get_produk(Request $request){
		$param = $request->except("pages","limit");
        $search = [];
        $limit = 8;
        if(strlen($request->get("limit")) > 0){
            $limit = $request->get("limit");
        }        
        $page = $request->get("pages");
        $ofset = ($page - 1) * $limit;
        if(count($param) > 0){
            foreach($param as $key => $value){
                if(!empty($value)){
                    if ($key == 'kategori_id') {
                        array_push($search, [$key, '=', $value]);
                    } else {
                        array_push($search, [$key, 'LIKE', '%'.$value.'%']);
                    }
                }
            }
        }

        $buy = false;
        $get_setting = St_Setting::first();
        $time_now = date("H:i:s");
        $setting_timefrom_open = $get_setting->setting_timefrom_open;
        $setting_timefrom_close = $get_setting->setting_timefrom_close;
       
        $dari = date("H:i",strtotime($setting_timefrom_open));
        $sampai = date("H:i",strtotime($setting_timefrom_close));
        $buy_keterangan = "Kami buka dari jam ".$dari." sampai jam ".$sampai;
        if (strtotime($time_now) >= strtotime($setting_timefrom_open) && strtotime($time_now) <= strtotime($setting_timefrom_close)) {
            $buy = true;  
            $buy_keterangan="";
        }       

        $data = Pr_Produk::where($search)
        		->where("produk_status",1)
        		->orderBy('produk_id', 'ASC')
        		->skip($ofset)
        		->limit($limit)->get(); 
        $param = array(
			"data" => $data,
            "buy" => $buy,
            "buy_keterangan" => $buy_keterangan
		);
		return view("pages/home/get_produk")->with($param);   
	}

}


?>