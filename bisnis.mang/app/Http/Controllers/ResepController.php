<?php
namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
class ResepController extends BaseController{

	public function index(){
		$param = array();
		return view("pages/resep/index")->with($param);
	}

	public function detail(){
		$param = array();
		return view("pages/resep/detail")->with($param);
	}

}
?>