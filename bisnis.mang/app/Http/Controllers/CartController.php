<?php

namespace App\Http\Controllers;

use App\Libs\Cart;
use App\Libs\Utility;
use App\Models\Cs_Address;
use App\Models\St_Setting;
use Illuminate\Http\Request;
use App\Models\state\St_Kota;
use App\Models\state\St_Provinsi;
use App\Models\state\St_Kecamatan;
use App\Models\state\St_Kelurahan;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller as BaseController;

class CartController extends BaseController
{

	public function store(Request $request)
	{
		if ($request->ajax()) {
			$produk_id        = $request->input("produk_id");
			$produk_nama      = $request->input("produk_nama");
			$produk_shortdesc = $request->input("produk_shortdesc");
			$harga_jual       = $request->input("harga_jual");
			$harga_promo      = $request->input("harga_promo");
			$produk_gambar    = $request->input("produk_gambar");
			$produk_someday   = $request->input("produk_someday");
			$produk_qty       = $request->input("produk_qty");
			$variant          = $request->input("variant");
			$catatan          = $request->input("catatan");

			$param = [
				"produk_id"        => $produk_id,
				"produk_nama"      => $produk_nama,
				"produk_shortdesc" => $produk_shortdesc,
				"harga_jual"       => $harga_jual,
				"harga_promo"      => $harga_promo,
				"produk_gambar"    => $produk_gambar,
				"produk_someday"   => $produk_someday,
				"produk_qty"       => $produk_qty,
				"variant"          => $variant,
				"catatan"          => $catatan,
			];

			Cart::add($param);
			$data = Cart::getAll();
			$total = count($data);
			$res = [
				"data" => $data,
				"total" => $total
			];
			return response()->json($res);
		}
	}

	public function delete(Request $request)
	{
		if ($request->ajax()) {
			$produk_id = $request->get("produk_id");
			Cart::delete($produk_id);
			$data = Cart::getAll();
			$total = count($data);
			$res = [
				"data" => $data,
				"total" => $total
			];
			return response()->json($res);
		}
	}

	public function get_produk(Request $request)
	{
		if ($request->ajax()) {
			$produk_data = Cart::getAll();
			$param = [
				"data" => $produk_data
			];

			return view("pages.cart.get_produk")->with($param);
		}
	}

	public function get_data(Request $request)
	{
		if ($request->ajax()) {
			$data = Cart::getAll();
			$subtotal = 0;
			$total_rupiah = 0;
			foreach ($data as $d) {
				$subtotal += Utility::get_harga_produk($d) * $d['produk_qty'];
			}
			$total_rupiah = $subtotal;

			$total = count($data);
			$res = [
				"data" => $data,
				"total" => $total,
				"total_rupiah" => "Rp. " . number_format($total_rupiah),
				"subtotal" => "Rp." . number_format($subtotal)
			];
			return response()->json($res);
		}
	}

	public function index()
	{
		$data = Cart::getAll();
		$total = count($data);
		$param = [];
		$layout = "index";
		if ($total < 1) {
			$layout = "cart_nodata";
		}
		return view("pages.cart." . $layout)->with($param);
	}

	public function address()
	{
		$user_data = Session::get("user_data");
		$user_data = json_decode($user_data, TRUE);
		$customer_id = $user_data['customer_id'];
		$get_address = Cs_Address::where("customer_id", $customer_id);
		if ($get_address->count() < 1) {
			return redirect()->route('cart.form_address');
		}
		$param = [
			"address_data" => $get_address->get()
		];

		return view("pages.cart.address")->with($param);
	}

	public function get_ongkir(Request $request)
	{
		if ($request->ajax()) {

			$validator = Validator::make($request->all(), [
				'address_id' => 'required'
			]);
			if ($validator->fails()) {
				return response()->json(['errors' => $validator->errors()], 500);
			}

			$data_address  = Cs_Address::where("address_id", $request->get("address_id"))->first();
			$data_kelurahan = St_Kelurahan::where("kelurahan_id", $data_address->kelurahan_id)->first();
			$kelurahan_ongkir = $data_kelurahan->kelurahan_ongkir;
			$kelurahan_feekurir_persentase = $data_kelurahan->kelurahan_feekurir_persentase;
			$data_setting = St_Setting::first();
			$setting_free_ongkir = $data_setting->setting_free_ongkir;
			$subtotal = Cart::getSubTotal();
			$ongkir = $data_kelurahan->kelurahan_ongkir;
			if ($setting_free_ongkir == 1) {
				$setting_free_ongkir_min = $data_setting->setting_free_ongkir_min;
				if ($subtotal > $setting_free_ongkir_min) {
					$ongkir = 0;
				}
				// elseif ($data_address->kelurahan_id == 3277020006 ) {
				// 	$ongkir = 10000;
				// }
				$ongkir;
			}

			$total_rupiah = $subtotal + $ongkir;
			$total_rupiah = "Rp. " . number_format($subtotal);
			$res = [
				"subtotal" => "Rp. " . number_format($subtotal),
				"ongkir" => $ongkir,
				"kelurahan_ongkir" => "Rp. " . number_format($kelurahan_ongkir),
				"total_rupiah" => "Rp. " . number_format($subtotal + $ongkir)
			];
			return response()->json($res);
			
		}
	}

	public function form_address(Request $request)
	{
		$param = [];
		$address_id_edit = "";
		$kelurahan_id_edit = "";
		$provinsi_id_edit = "";
		$kota_id_edit = "";
		$kecamatan_id_edit  = "";
		$address_detail_edit = "";
		$address_utama_edit = "";

		$title = "Tambah Alamat";
		if ($request->get("edit")) {
			$address_id_edit = $request->get("edit");
			$data_address = Cs_Address::join("st_kelurahan", "st_kelurahan.kelurahan_id", "=", "cs_address.kelurahan_id")
				->join("st_kecamatan", "st_kecamatan.kecamatan_id", "=", "st_kelurahan.kelurahan_kec_id")
				->join("st_kota", "st_kota.kota_id", "=", "st_kecamatan.kecamatan_kota_id")
				->join("st_provinsi", "st_kota.kota_provinsi_id", "=", "st_provinsi.provinsi_id")
				->where("address_id", $address_id_edit)->first();
			$kelurahan_id_edit = $data_address->kelurahan_id;
			$title  = "Ubah Alamat";
			$kecamatan_id_edit = $data_address->kecamatan_id;
			$kota_id_edit = $data_address->kota_id;
			$provinsi_id_edit = $data_address->provinsi_id;
			$address_detail_edit = $data_address->address_detail;
			$address_utama_edit = $data_address->address_utama;
		}

		$provinsi_data = St_Provinsi::orderBy("provinsi_name", 'ASC')
			->where("provinsi_status", 1)
			->first();

		$provinsi_id = $provinsi_data['provinsi_id'];
		$provinsi_name = $provinsi_data['provinsi_name'];

		$kota_data = St_Kota::orderBy("kota_name", 'ASC')
			->where("kota_provinsi_id", $provinsi_id)
			->get();

		$param = [
			"provinsi_id" => $provinsi_id,
			"provinsi_name" => $provinsi_name,
			"kota_data" => $kota_data,
			"address_id_edit"  => $address_id_edit,
			"address_utama_edit"  => $address_utama_edit,
			"kota_id_edit"  => $kota_id_edit,
			"kecamatan_id_edit"  => $kecamatan_id_edit,
			"kelurahan_id_edit"  => $kelurahan_id_edit,
			"address_detail_edit"  => $address_detail_edit,
			"provinsi_id_edit"  => $provinsi_id_edit,
			"title" => $title
		];

		return view("pages.cart.form_address")->with($param);
	}

	public function store_address(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'select_provinsi' => 'required',
			'select_kota' => 'required',
			'select_kecamatan' => 'required',
			'select_kelurahan' => 'required',
			'address_detail' => 'required'
		]);
		if ($validator->fails()) {
			return response()->json(['errors' => $validator->errors()], 500);
		}

		$provinsi = $request->get("select_provinsi");
		$kota = $request->get("select_kota");
		$kecamatan = $request->get("select_kecamatan");
		$kelurahan = $request->get("select_kelurahan");
		$address_detail = $request->get("address_detail");

		$address_utama = 0;
		if ($request->get("address_utama")) {
			$address_utama = 1;
		}
		$user_data = Session::get("user_data");
		$user_data = json_decode($user_data, TRUE);
		$customer_id = $user_data['customer_id'];
		if ($address_utama == 1) {
			Cs_Address::where("customer_id", $customer_id)->update(['address_utama' => 0]);
		}

		$get_provinsi = St_Provinsi::where("provinsi_id", $provinsi)->first();
		$provinsi_name = $get_provinsi['provinsi_name'];

		$get_kota = St_Kota::where("kota_id", $kota)->first();
		$kota_name = $get_kota['kota_name'];

		$get_kecamatan = St_Kecamatan::where("kecamatan_id", $kecamatan)->first();
		$kecamatan_name = $get_kecamatan['kecamatan_name'];

		$get_kelurahan = St_Kelurahan::where("kelurahan_id", $kelurahan)->first();
		$kelurahan_name = $get_kelurahan['kelurahan_name'];

		$param = [
			"customer_id" => $customer_id,
			"kelurahan_id" => $kelurahan,
			"provinsi_name" => $provinsi_name,
			"kota_name" => $kota_name,
			"kecamatan_name" => $kecamatan_name,
			"kelurahan_name" => $kelurahan_name,
			"address_detail" => $address_detail,
			"address_utama" => $address_utama
		];

		Cs_Address::create($param);

		$res = [
			"success" => 1,
			"message" => "Alamat berhasil di tambahkan"
		];

		return response()->json($res, 200);
	}

	public function update_address(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'address_id' => 'required',
			'select_provinsi' => 'required',
			'select_kota' => 'required',
			'select_kecamatan' => 'required',
			'select_kelurahan' => 'required',
			'address_detail' => 'required'
		]);
		if ($validator->fails()) {
			return response()->json(['errors' => $validator->errors()], 500);
		}

		$provinsi = $request->get("select_provinsi");
		$kota = $request->get("select_kota");
		$kecamatan = $request->get("select_kecamatan");
		$kelurahan = $request->get("select_kelurahan");
		$address_detail = $request->get("address_detail");

		$address_utama = 0;
		if ($request->get("address_utama")) {
			$address_utama = 1;
		}
		$user_data = Session::get("user_data");
		$user_data = json_decode($user_data, TRUE);
		$customer_id = $user_data['customer_id'];
		if ($address_utama == 1) {
			Cs_Address::where("customer_id", $customer_id)->update(['address_utama' => 0]);
		}

		$get_provinsi = St_Provinsi::where("provinsi_id", $provinsi)->first();
		$provinsi_name = $get_provinsi['provinsi_name'];

		$get_kota = St_Kota::where("kota_id", $kota)->first();
		$kota_name = $get_kota['kota_name'];

		$get_kecamatan = St_Kecamatan::where("kecamatan_id", $kecamatan)->first();
		$kecamatan_name = $get_kecamatan['kecamatan_name'];

		$get_kelurahan = St_Kelurahan::where("kelurahan_id", $kelurahan)->first();
		$kelurahan_name = $get_kelurahan['kelurahan_name'];

		$param = [
			"customer_id" => $customer_id,
			"kelurahan_id" => $kelurahan,
			"provinsi_name" => $provinsi_name,
			"kota_name" => $kota_name,
			"kecamatan_name" => $kecamatan_name,
			"kelurahan_name" => $kelurahan_name,
			"address_detail" => $address_detail,
			"address_utama" => $address_utama
		];

		Cs_Address::where("address_id", $request->get("address_id"))->update($param);

		$res = [
			"success" => 1,
			"message" => "Alamat berhasil di ubah"
		];

		return response()->json($res, 200);
	}

	public function store_confirm(Request $request)
	{
		if ($request->ajax()) {
			$validator = Validator::make($request->all(), [
				'address_id' => 'required'
			]);
			if ($validator->fails()) {
				return response()->json(['errors' => $validator->errors()], 500);
			}

			$data_address = Cs_Address::with("kelurahan")->where("address_id", $request->get("address_id"))
				->first();

			Session::put('address', json_encode($data_address));
			return response()->json($data_address);
		}
	}

	public function confirm()
	{
		if (!Session::has("address") || !Session::has("produk_data")) {
			return redirect()->route('index');
		}
		$address = json_decode(Session::get("address"), true);
		$produk = Session::get("produk_data");
		$produk = json_decode($produk, TRUE);

		//-------------Validasi someday-------------------------------------
		$data_setting = St_Setting::first();
		$setting_timefrom_someday = $data_setting->setting_timefrom_someday;
		$setting_timeto_someday = $data_setting->setting_timeto_someday;
		$time_now = date("H:i:s");
		$setting_timefrom_someday_hour = date("H:i", strtotime($setting_timefrom_someday));
		$setting_timeto_someday_hour = date("H:i", strtotime($setting_timeto_someday));
		$someday = false;
		$someday_keterangan = "Pengiriman hari ini dimulai dari jam $setting_timefrom_someday_hour sampai $setting_timeto_someday_hour";
		if (strtotime($time_now) >= strtotime($setting_timefrom_someday) && strtotime($time_now) <= strtotime($setting_timeto_someday)) {
			$someday = true;
			$someday_keterangan = "";
		}

		if ($someday) {
			$produk_data = [];
			foreach ($produk as $pd) {
				if ($pd['produk_someday'] != 1) {
					$produk_data[] = $pd['produk_nama'];
					$someday = false;
				}
			}
			if (!$someday) {
				$produk_data = implode(", ", $produk_data);
				$someday_keterangan = "Pengiriman hari ini tidak tersedia karena didalam keranjang ada produk yang tidak masuk dalam kategori produk someday ($produk_data)";
			}
		}
		//-------------Validasi someday-------------------------------------

		$param = [
			"data" => $address,
			"produk" => $produk,
			"someday" => $someday,
			"someday_keterangan" => $someday_keterangan
		];

		return view("pages.cart.confirm")->with($param);
	}

	public function done()
	{
		$param = [];
		return view("pages.cart.done")->with($param);
	}
}
