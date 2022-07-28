<?php

namespace App\Http\Controllers;

use App\Models\Cs_Customer;
use Illuminate\Http\Request;
use App\Models\transaction\Tr_Order;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\UserRegistrationRequest;
use App\Http\Controllers\Controller as BaseController;

class AuthController extends BaseController
{
	public function index()
	{
		$param = [];
		return view("pages.auth.login")->with($param);
	}

	public function profile()
	{
		$user_data   = Session::get("user_data");
		$user_data   = json_decode($user_data, TRUE);
		$customer_id = $user_data['customer_id'];
		$total_order = Tr_Order::where("customer_id", $customer_id)->count();

		$total_order_proses  = Tr_Order::where("customer_id", $customer_id)->whereIn("order_status", ['draft', 'approve-admin', 'ongoing'])->count();
		$total_order_selesai = Tr_Order::where("customer_id", $customer_id)->whereIn("order_status", ['finish'])->count();
		$total_order_cancel  = Tr_Order::where("customer_id", $customer_id)->whereIn("order_status", ['cancel-admin', 'cancel-user'])->count();

		$param = [
			"user_data"   => $user_data,
			"total_order" => $total_order,
			"total_order_proses"  => $total_order_proses,
			"total_order_selesai" => $total_order_selesai,
			"total_order_cancel"  => $total_order_cancel
		];

		return view("pages.auth.profile")->with($param);
	}

	public function get_user_data(Request $request)
	{
		$user_data = Session::get("user_data");
		$login = false;
		if ($user_data != null) {
			$login = true;
		}

		$res = array(
			"login" => $login,
			"data" => $user_data
		);

		return response()->json($res, 200);
	}

	public function login(UserRegistrationRequest $request)
	{
		$customer_wa     = trim($request->input("customer_wa"));
		$customer_name   = $request->input("customer_name");
		$nama_pic        = $request->input("nama_pic");
		$jenis_usaha     = $request->input("jenis_usaha");
		$alamat_usaha    = $request->input("alamat_usaha");
		$jam_operasional = $request->input("jam_operasional");
		$jam_pengiriman  = $request->input("jam_pengiriman");
		$get_user_data   = Cs_Customer::where("customer_wa", $customer_wa)->first();

		$data = [];
		if ($get_user_data) {
			$data = $get_user_data;
		} else {
			$param = [
				"customer_name"            => $customer_name,
				"customer_wa"              => $customer_wa,
				"customer_nama_pic"        => $nama_pic,
				"customer_jenis_usaha"     => $jenis_usaha,
				"customer_alamat_usaha"    => $alamat_usaha,
				"customer_jam_operasional" => $jam_operasional,
				"customer_jam_pengiriman"  => $jam_pengiriman,
				"customer_created"         => date("Y-m-d H:i:s")
			];

			Cs_Customer::create($param);
			$data = Cs_Customer::where("customer_wa", $request->get("customer_wa"))->first();
		}

		Session::put("user_data", json_encode($data));
		$res = [
			"data" => $data
		];

		return response()->json($res, 200);
	}

	public function logout(Request $request)
	{
		Session::forget("user_data");
		return redirect()->route('index');
	}
}
