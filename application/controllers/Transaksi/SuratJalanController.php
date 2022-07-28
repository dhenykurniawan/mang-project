<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SuratJalanController extends CI_Controller {

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
		$this->load->model('kurir/KurirModel');
		$data_kurir = $this->KurirModel->getAll();
		$modal_form_data = array(
			"data_kurir" => $data_kurir
		);
		$modal_form = $this->load->view("transaksi/surat_jalan/form",$modal_form_data,TRUE);
		$ct = array(
			"form" => $modal_form
		);
		$content = $this->load->view("transaksi/surat_jalan/index",$ct,TRUE);
		$dt = array(
			"content" => $content
		);
		$this->load->view("layout/index",$dt);
	}

	public function store(){
		if(count($_POST)>0){
			$this->form_validation->set_rules('kurir_id','Nama Kurir','required');
			$this->form_validation->set_rules('sj_tanggal','Alamat Kurir','required');
			$this->form_validation->set_rules('order_id[]',"Duration", "required");
			if($this->form_validation->run() == false){
				$resp = array(
					"success" => 0,
					"message" => "Form bertanda * wajib di isi"
				);
				echo json_encode($resp);
				exit;
			}
			else{
				$this->load->model('transaksi/SuratJalanModel');
				$store = $this->SuratJalanModel->store($this->input->post());
				echo json_encode($store);
				exit;
			}
		}
	}

	public function update(){
		if(count($_POST)>0){
			$this->form_validation->set_rules('invoice_id','Nama Kurir','required');
			$this->form_validation->set_rules('order_id','Nama Kurir','required');
			$this->form_validation->set_rules('invoice_total','Alamat Kurir','required');
			if($this->form_validation->run() == false){
				$resp = array(
					"success" => 0,
					"message" => "Form bertanda * wajib di isi"
				);
				echo json_encode($resp);
				exit;
			}
			else{
				
				$this->load->model('transaksi/InvoiceModel');
				$store = $this->InvoiceModel->update($this->input->post());
				echo json_encode($store);
				exit;
			}
		}
	}

	public function delete(){
		if(count($_GET)>0){
			$this->load->model('transaksi/SuratJalanModel');
			$get = $this->SuratJalanModel->delete($this->input->get("sj_id"));
			echo json_encode($get);
		}
	}

	public function show(){
		if(count($_GET)>0){
			$this->load->model('transaksi/InvoiceModel');
			$get = $this->InvoiceModel->show($this->input->get("invoice_id"));
			echo json_encode($get);
		}
	}

	

	public function get_data(){
		if(count($_GET)>0){
			 $columns = [ 
	             0 => 'tr_surat_jalan.sj_id',
	             1 => 'tr_surat_jalan.sj_tanggal',
	             2 => 'mt_kurir.kurir_nama',
	             3 => 'tr_surat_jalan.sj_total'
	        ];
			$limit = $this->input->get('length');
	        $start = $this->input->get('start');
	        $search = $this->input->get('columns');
	        $orderBy = $this->input->get('order');
	        $resp = array();
	        $queryParam = [
	            'page' => $start,
	            'limit' => $limit,
	            'order' => $columns[$orderBy[0]['column']],
	            'sort' => $orderBy[0]['dir']
	        ];
	       	$this->load->model('transaksi/SuratJalanModel');
	       	$data = $this->SuratJalanModel->getData($queryParam,$columns,$search);
	        $return = [];
        	$resp['draw'] = (int)$this->input->get('draw');
        	$temp_data = array();
        	foreach ($data['data'] as $dt) {
        		$button = "";
				$button = "<button class='btn btn-circle waves-effect waves-circle waves-float btn-primary' onclick='print(`".$dt['sj_id']."`)'><i class='material-icons'>print</i></button>";
				$button_delete = "<button class='tn btn-circle waves-effect waves-circle waves-float btn-danger' onclick='show_delete(`".$dt['sj_id']."`)'><i class='material-icons'>delete</i></button>";

        		$p = array(
        			"sj_id" => $dt['sj_id'],
        			"sj_tanggal" => $dt['sj_tanggal'],
        			"kurir_nama" => $dt['kurir_nama'],
        			"sj_total" => number_format($dt['sj_total']),
        			"button" => $button." ".$button_delete
        		);
        		$temp_data[] = $p;
        		
        	}
        	$resp['data'] = $temp_data;
        	$resp['recordsTotal'] = count($temp_data);
        	$resp['recordsFiltered'] = $data['total_data'];
        	
        	echo json_encode($resp);
		}
	}

	public function print(){
		if(isset($_GET['sj_id'])){
			$sj_id = $this->input->get("sj_id");
			$this->load->model('transaksi/SuratJalanModel');
	       	$data = $this->SuratJalanModel->get_print($sj_id);
	       	$this->load->view("transaksi/surat_jalan/print",$data);
		}
	}

	

}
