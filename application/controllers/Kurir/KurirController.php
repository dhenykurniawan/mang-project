<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KurirController extends CI_Controller {

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
		$modal_form = $this->load->view("kurir/form",array(),TRUE);
		$ct = array(
			"form" => $modal_form
		);
		$content = $this->load->view("kurir/index",$ct,TRUE);
		$dt = array(
			"content" => $content
		);
		$this->load->view("layout/index",$dt);
	}

	public function store(){
		if(count($_POST)>0){
			$this->form_validation->set_rules('kurir_nama','Nama Kurir','required');
			$this->form_validation->set_rules('kurir_alamat','Alamat Kurir','required');
			$this->form_validation->set_rules('kurir_wa','Alamat Kurir','required');
			$this->form_validation->set_rules('kurir_nopol','Alamat Kurir','required');
			
			if (empty($_FILES['kurir_ktp']['name'])){
			    $this->form_validation->set_rules('kurir_ktp', 'Document', 'required');
			}
			if($this->form_validation->run() == false){
				$resp = array(
					"success" => 0,
					"message" => "Form bertanda * wajib di isi"
				);
				echo json_encode($resp);
				exit;
			}
			else{
				$this->load->model('kurir/KurirModel');
				$store = $this->KurirModel->store($this->input->post(),$_FILES['kurir_ktp']);
				echo json_encode($store);
				exit;
			}
		}
	}

	public function update(){
		if(count($_POST)>0){
			$this->form_validation->set_rules('kurir_nama','Nama Kurir','required');
			$this->form_validation->set_rules('kurir_alamat','Alamat Kurir','required');
			$this->form_validation->set_rules('kurir_wa','Alamat Kurir','required');
			$this->form_validation->set_rules('kurir_nopol','Alamat Kurir','required');
			if($this->form_validation->run() == false){
				$resp = array(
					"success" => 0,
					"message" => "Form bertanda * wajib di isi"
				);
				echo json_encode($resp);
				exit;
			}
			else{
				$this->load->model('kurir/KurirModel');
				$store = $this->KurirModel->update($this->input->post(),$_FILES['kurir_ktp']);
				echo json_encode($store);
				exit;
				
			}
		}
	}

	public function delete(){
		if(count($_GET)>0){
			$this->load->model('kurir/KurirModel');
			$get = $this->KurirModel->delete($this->input->get("kurir_id"));
			echo json_encode($get);
		}
	}

	public function show(){
		if(count($_GET)>0){
			$this->load->model('kurir/KurirModel');
			$get = $this->KurirModel->show($this->input->get("kurir_id"));
			echo json_encode($get);
		}
	}

	public function get_data(){
		if(count($_GET)>0){
			 $columns = [ 
	             1 => 'kurir_nama',
	             2 => 'kurir_wa',
	             3 => 'kurir_nopol'
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
	       	$this->load->model('kurir/KurirModel');
	       	$data = $this->KurirModel->getData($queryParam,$columns,$search);
	        $return = [];
        	$resp['draw'] = (int)$this->input->get('draw');
        	$temp_data = array();
        	foreach ($data['data'] as $dt) {

        		$html_icon = "<img src='".get_file('kurir/',$dt['kurir_ktp'])."' width=50 height=50 />";
        		$button_edit = "<button class='btn btn-small btn-warning' onclick='show_edit(".$dt['kurir_id'].")'>Edit</button>";
				$button_delete = "<button class='btn btn-small btn-danger' onclick='show_delete(".$dt['kurir_id'].")'>Hapus</button>";

        		$p = array(
        			"kurir_ktp" => $html_icon,
        			"kurir_nama" => $dt['kurir_nama'],
        			"kurir_wa" => $dt['kurir_wa'],
        			"kurir_nopol" => $dt['kurir_nopol'],
        			"button" => $button_edit
        		);
        		$temp_data[] = $p;
        		
        	}
        	$resp['data'] = $temp_data;
        	$resp['recordsTotal'] = count($temp_data);
        	$resp['recordsFiltered'] = $data['total_data'];
        	
        	echo json_encode($resp);
		}
	}

	

}
