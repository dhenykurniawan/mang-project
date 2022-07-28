<?php

namespace App\Libs;
use Session;
class Cart{

	public static function add($produk_data){
		$cache_data = json_decode(Session::get('produk_data'),TRUE);
		$pd_data = array();
		if($cache_data!=null){
			if(count($cache_data)<1){
				$pd_data[] = $produk_data;
			}
			else{
				$check_produk = false;
				foreach ($cache_data as &$cd) {
					$p = $cd;
					if($produk_data['produk_id'] == $cd['produk_id']){
						$cd['produk_qty']=$produk_data['produk_qty'];
						$p = $cd;
						$check_produk = true;
					}
					$pd_data[] = $cd;
				}
				if(!$check_produk){
					$pd_data[] = $produk_data;
				}
			}

		}
		else{
			$pd_data[] = $produk_data;
		}
		
		Session::put('produk_data', json_encode($pd_data));
	}

	public static function getAll(){
		$cache_data = json_decode(Session::get('produk_data'),TRUE);
		if($cache_data==null){
			return[];
		}
		return  $cache_data;
	}

	public static function getSubTotal(){
		$data = Cart::getAll();
		$subtotal=0;
		foreach ($data as $d) {
			$subtotal+=Utility::get_harga_produk($d) * $d['produk_qty'];
		}
		return $subtotal;
	}

	public static function getOne($produk_id){
		$cache_data = json_decode(Session::get('produk_data'),TRUE);
		if($cache_data==null){
			return[];
		}
		foreach ($cache_data as $cd) {
			if($produk_id==$cd['produk_id']){	
				return  $cd;
			}
		}
		return[];
		
	}

	public static function delete($produk_id){
		$cache_data = json_decode(Session::get('produk_data'),TRUE);
		if($cache_data==null){
			return[];
		}

		$i=0;
		foreach ($cache_data as &$cd) {
			if($produk_id==$cd['produk_id']){
				unset($cache_data[$i]);
			}
			$i++;
		}
		$cache_data = array_values($cache_data);
		Session::put('produk_data', json_encode($cache_data));
		
	}	

}


?>