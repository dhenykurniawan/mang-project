<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class UploadController extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct(){
		parent:: __construct();
		$session =  $this->session->userdata("user_id");
		if($session==null){
			redirect(base_url());
		}

	}

	public function index(){
		

		$this->load->view("layout/excel",array());
	}

	public function store(){
		
		$config['upload_path']          = FCPATH.'/assets/uploads/produk/';
        $config['file_name']            = $_FILES['file_name']['name'];
        $config['overwrite']            = true;
        /*$config['max_size']             = 1024; // 1MB
        $config['max_width']            = 1080;
        $config['max_height']           = 1080;*/
        $this->load->library('upload', $config);
		$reader 	= new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		$file_data 	= $this->upload->data();
		$file_name 	= $config['upload_path'].$file_data['file_name'];
		$arr_file 	= explode('.', $file_name);
		$extension 	= end($arr_file);
		$spreadsheet 	= $reader->load($file_name);
		$sheet_data 	= $spreadsheet->getActiveSheet()->toArray();
		foreach($sheet_data as $key => $val) {
			if($key!=0){
				$category = $val[6];
				$category_id = "";
				if($category=="Buah"){
					$category_id = "2";
				}
				else if($category=="Buah,Sayuran" || $category=="Sayuran"){
					$category_id = "4";
				}
				else if($category=="Bumbu dan Rempah"){
					$category_id = "3";
				}
				else if($category=="Daging"){
					$category_id = "1";
				}
				else if($category=="Makanan dan Minuman"){
					$category_id = "5";
				}
				else if($category=="Sembako"){
					$category_id = "6";
				}

				if(strlen($category_id)>0){
					$produk_name = $val[0];
					$image_url = $val[1];
					$produk_desc = $val[2];
					$produk_jual = $val[3];
					$produk_promo = $val[4];
					$produk_beli = $val[7];
					$file_name = basename($image_url);
					if(strlen($produk_desc)<1){
						$produk_desc = "-";
					}
					//file_put_contents($config['upload_path'].$file_name, file_get_contents($image_url));
					$param = array(
						"kategori_id" => $category_id,
						"produk_nama" => $produk_name,
						"produk_shortdesc" => $produk_desc,
						"produk_desc" => $produk_desc,
						"harga_beli" => $produk_beli,
						"harga_jual" => $produk_jual,
						"harga_promo" => $produk_promo,
						"produk_status" => 1,
						"produk_someday" => 1,
						"produk_gambar" => $file_name,
						"produk_createdby" => 1,
						"produk_created" => date("Y-m-d H:i:s")
					);

					$this->db->insert("pr_produk",$param);

				}
				
				
			}
			
		}
	}


	

}
