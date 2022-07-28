<?php

namespace App\Libs;

use App\Models\St_Setting;
use Illuminate\Support\Facades\Session;

class Utility
{

	public static function get_harga_produk($object)
	{
		$user_data = json_decode(Session::get("user_data"));
		$harga = $object['harga_jual'];
		if ($object['harga_promo'] > 0) {
			$harga = $object['harga_promo'];
		} else if (isset($object['variants']) && count($object['variants']) > 0) {
			$harga_bisnis = $object['variants'][0]['produk_variant_harga_jual_bisnis'];
			$harga_biasa = $object['variants'][0]['produk_variant_harga_jual'];
			if ($harga_bisnis > 0 && !is_null(@$user_data->customer_jenis_usaha)) {
				$harga = $harga_bisnis;
			} else {
				$harga = $harga_biasa;
			}
		}

		return $harga;
	}

	public static function getSetting()
	{
		$data_setting = St_Setting::first();
		$data_setting->setting_no_wa = Utility::wa_number($data_setting->setting_no_wa);

		return $data_setting;
	}

	public static function wa_number($nohp)
	{
		$nohp = str_replace(" ", "", $nohp);
		$nohp = str_replace("(", "", $nohp);
		$nohp = str_replace(")", "", $nohp);
		$nohp = str_replace(".", "", $nohp);
		if (!preg_match('/[^+0-9]/', trim($nohp))) {
			if (substr(trim($nohp), 0, 3) == '%2B62') {
				$hp = trim($nohp);
			} elseif (substr(trim($nohp), 0, 1) == '0') {
				$hp = '%2B62' . substr(trim($nohp), 1);
			}
		}
		return $hp;
	}
}
