<?php

namespace App\Http\Controllers;

use App\Libs\Cart;
use App\Libs\Utility;
use App\Models\Us_Notif;
use App\Models\Pr_Produk;
use App\Models\Cs_Address;
use App\Models\St_Setting;
use Illuminate\Http\Request;
use App\Models\state\St_Kelurahan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\transaction\Tr_Order;
use App\Models\transaction\Tr_Produk;
use App\Models\transaction\Inv_Invoice;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller as BaseController;

class OrderController extends BaseController
{
	public function store(Request $request)
	{
		if ($request->ajax()) {
			$validator = Validator::make($request->all(), [
				'order_payment_method' => 'required',
				'order_tanggal' => 'required'
			]);

			if ($validator->fails()) {
				return response()->json(['errors' => $validator->errors()], 500);
			}

			try {
				DB::beginTransaction();
				try {

					$produk = Cart::getAll();
					if (count($produk) <= 0) {
						return response()->json(['message' => "Produk Not found"], 400);
					}

					$user_data = Session::get("user_data");
					$user_data = json_decode($user_data, TRUE);
					$customer_id = $user_data['customer_id'];

					$address = Session::get("address");
					$address = json_decode($address, TRUE);
					$kelurahan_ongkir = $address['kelurahan']['kelurahan_ongkir'];
					$kelurahan_feekurir_persentase = $address['kelurahan']['kelurahan_feekurir_persentase'];
					$data_setting = St_Setting::first();
					$setting_free_ongkir = $data_setting->setting_free_ongkir;
					$subtotal = Cart::getSubTotal();
					$ongkir = $kelurahan_ongkir;
					$kelurahan_feekurir_persentase = $address['kelurahan']['kelurahan_feekurir_persentase'] / 100;

					$order_fee_ongkir = $kelurahan_ongkir * $kelurahan_feekurir_persentase;
					if ($setting_free_ongkir == 1) {
						$setting_free_ongkir_min = $data_setting->setting_free_ongkir_min;
						if ($subtotal > $setting_free_ongkir_min) {
							$ongkir = 0;
						}
					}

					$total_rupiah = $subtotal + $ongkir;
					$param = [
						"customer_id"          => $customer_id,
						"order_subtotal"       => $subtotal,
						"order_diskon"         => 0,
						"order_total"          => $total_rupiah,
						"order_nama"           => $user_data['customer_name'],
						"order_kelurahan_id"   => $address['kelurahan_id'],
						"order_kelurahan"      => $address['kelurahan']['kelurahan_name'],
						"order_kecamatan"      => $address['kecamatan_name'],
						"order_kota"           => $address['kota_name'],
						"order_provinsi"       => $address['provinsi_name'],
						"order_alamat"         => $address['address_detail'],
						"order_wa"             => $user_data['customer_wa'],
						"order_ongkir"         => $ongkir,
						"order_fee_ongkir"     => $order_fee_ongkir,
						"order_status"         => 'draft',
						"order_payment_method" => $request->get("order_payment_method"),
						"order_tanggal"        => $request->get("order_tanggal"),
						"order_created"        => date("Y-m-d H:i:s")
					];
					$order = Tr_Order::create($param);
					$order_id = $order->order_id;

					foreach ($produk as $pd) {
						$total = Utility::get_harga_produk($pd) * $pd['produk_qty'];
						$produk_master = Pr_Produk::select("harga_beli")->where("produk_id", $pd['produk_id'])->first();
						$param = [
							"order_id"      => $order_id,
							"produk_id"     => $pd['produk_id'],
							"trp_hargajual" => Utility::get_harga_produk($pd),
							"trp_diskon"    => 0,
							"trp_qty"       => $pd['produk_qty'],
							"trp_total"     => $total,
							"trp_hargabeli" => $produk_master->harga_beli,
							"variant"       => $pd['variant'] !== 'null' ? $pd['variant'] : null
						];
						Tr_Produk::create($param);
					}
					$param = [
						"order_id" => $order_id,
						"invoice_total" => $total_rupiah,
						"invoice_created" => date("Y-m-d H:i:s")
					];

					Inv_Invoice::create($param);
					$param = [
						"notif_type" => "order",
						"notif_conid" => $order_id,
						"notif_read" => "0",
						"notif_message" => "Ada Order Masuk dari " . $order['order_wa'],
						"notif_created" => date("Y-m-d H:i:s")
					];
					Us_Notif::create($param);
					Session::forget("produk_data", "address");
					DB::commit();
					return response()->json(['message' => "Order Created"], 200);
				} catch (\Exception $e) {
					Log::channel('slack')->info($e->getMessage());
					DB::rollback();
					return $e->getMessage();
				}
			} catch (\Exception $e) {
				Log::channel('slack')->info($e->getMessage());
				return $e->getMessage();
			}
		}
	}

	public function process()
	{
		$param = [
			"title" => "Daftar Order Proses",
			"status" => "process"
		];
		return view("pages/order/index")->with($param);
	}

	public function get_order_data(Request $request)
	{
		if ($request->ajax()) {
			$status = $request->get("status");
			$pages = $request->get("pages");
			$param = $request->except("pages", "status");
			$search = [];
			$limit = 8;
			if (strlen($request->get("limit")) > 0) {
				$limit = $request->get("limit");
			}
			$page = $request->get("pages");
			$ofset = ($page - 1) * $limit;
			if (count($param) > 0) {
				foreach ($param as $key => $value) {
					if (!empty($value)) {
						if ($key == 'kategori_id') {
							array_push($search, [$key, '=', $value]);
						} else {
							array_push($search, [$key, 'LIKE', '%' . $value . '%']);
						}
					}
				}
			}

			$in_status = [];
			$status = $request->get("status");
			if ($status == "process") {
				$in_status = ['draft', 'approve-admin', 'ongoing'];
			} else if ($status == "finish") {
				$in_status = ['finish'];
			} else if ($status == "cancel") {
				$in_status = ['cancel-admin', 'cancel-user'];
			}

			$user_data = Session::get("user_data");
			$user_data = json_decode($user_data, TRUE);

			if (count($in_status) < 1) {
				$data = Tr_Order::where($search)
					->with("tr_produk")
					->where("customer_id", $user_data['customer_id'])
					->orderBy('order_created', 'DESC')
					->skip($ofset)
					->limit($limit)->get();
			} else {
				$data = Tr_Order::where($search)
					->with("tr_produk")
					->where("customer_id", $user_data['customer_id'])
					->where("order_status", $in_status)
					->orderBy('order_created', 'DESC')
					->skip($ofset)
					->limit($limit)->get();
			}

			$param = [
				"data" => $data,
				"text_class" => "text-primary"
			];
			return view("pages/order/get_order_data")->with($param);
		}
	}

	public function finish()
	{
		$param = [
			"title" => "Daftar Order Selesai",
			"status" => "finish"
		];
		return view("pages/order/index")->with($param);
	}

	public function cancel()
	{
		$param = [
			"title" => "Daftar Order Cancel",
			"status" => "cancel"
		];
		return view("pages/order/index")->with($param);
	}

	public function history()
	{
		$param = [
			"title" => "Histori Order",
			"status" => ""
		];
		return view("pages/order/index")->with($param);
	}
}
