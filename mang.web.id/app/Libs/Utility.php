<?php

namespace App\Libs;

use App\Models\St_Setting;

class Utility{

	public static function get_harga_produk($object){
		$harga = $object['harga_jual'];
		if($object['harga_promo']>0){
			$harga = $object['harga_promo'];
		}
		return $harga;
	}

	public static function getSetting(){
		$data_setting = St_Setting::first();
		$data_setting->setting_no_wa = Utility::wa_number($data_setting->setting_no_wa);
		return $data_setting;
	}

	public static function wa_number($nohp) {
     $nohp = str_replace(" ","",$nohp);
     $nohp = str_replace("(","",$nohp);
     $nohp = str_replace(")","",$nohp);
     $nohp = str_replace(".","",$nohp);
     if(!preg_match('/[^+0-9]/',trim($nohp))){
         if(substr(trim($nohp), 0, 3)=='%2B62'){
             $hp = trim($nohp);
         }
         elseif(substr(trim($nohp), 0, 1)=='0'){
             $hp = '%2B62'.substr(trim($nohp), 1);
         }
     }
     return $hp;
 }


}


?>