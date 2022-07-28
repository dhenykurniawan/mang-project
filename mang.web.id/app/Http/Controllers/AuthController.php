<?php
namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Validator;
use App\Models\Cs_Customer;
use App\Models\transaction\Tr_Order;
class AuthController extends BaseController{

	public function index(){
		$param = array();
		return view("pages/auth/login")->with($param);
	}

	public function profile(){
		$user_data = Session::get("user_data");
		$user_data = json_decode($user_data,TRUE);
		$customer_id = $user_data['customer_id'];
		$total_order = Tr_Order::where("customer_id",$customer_id)->count();
		$total_order_proses = Tr_Order::where("customer_id",$customer_id)
							->whereIn("order_status",['draft','approve-admin','ongoing'])->count();
		$total_order_selesai = Tr_Order::where("customer_id",$customer_id)
							->whereIn("order_status",['finish'])->count();
		$total_order_cancel = Tr_Order::where("customer_id",$customer_id)
							->whereIn("order_status",['cancel-admin','cancel-user'])->count();

		$param = array(
			"user_data" => $user_data,
			"total_order" => $total_order,
			"total_order_proses" => $total_order_proses,
			"total_order_selesai" => $total_order_selesai,
			"total_order_cancel" => $total_order_cancel

		);
		return view("pages/auth/profile")->with($param);
	}

	public function get_user_data(Request $request){
		$user_data = Session::get("user_data");
		$login = false;
		if($user_data!=null){
			$login = true;
		}

		$res = array(
			"login" => $login,
			"data" => $user_data
		);

		return response()->json($res,200);

	}

	public function login(Request $request){

		 $validator = Validator::make($request->all(), [
            'customer_wa' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()], 401);
        }

       $customer_wa = trim($request->get("customer_wa"));	
		$get_user_data = Cs_Customer::where("customer_wa",$customer_wa)
						->first();
		$data = array();
		if($get_user_data){
			$data = $get_user_data;
		}
		else{
			
			$param = array(
				"customer_wa" => $customer_wa,
				"customer_created" => date("Y-m-d H:i:s")
			);

			if($request->get("customer_name")){
				$param['customer_name'] = $request->get("customer_name");
			}

			Cs_Customer::create($param);
			$data = Cs_Customer::where("customer_wa",$request->get("customer_wa"))
						->first();
		}
		Session::put("user_data",json_encode($data));
		$res = array(
			"data" => $data
		);

		return response()->json($res,200);

	}

	public function logout(Request $request){
		Session::forget("user_data");
		return redirect()->route('index');
	}

	

}
?>