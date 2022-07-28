<?php
namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
class KontenController extends BaseController{

	public function index(){
		$param = array();
		return view("pages/konten/index")->with($param);
	}

	public function detail(){
		$param = array();
		return view("pages/konten/detail")->with($param);
	}

}
?>