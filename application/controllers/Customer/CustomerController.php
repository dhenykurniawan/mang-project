<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CustomerController extends CI_Controller {

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
		$ct = array();
		$content = $this->load->view("customer/index",$ct,TRUE);
		$dt = array(
			"content" => $content
		);
		$this->load->view("layout/index",$dt);
	}

	public function show(){
		if(count($_GET)>0){
			$this->load->model('produk/kategori/KategoriModel');
			$get = $this->KategoriModel->show($this->input->get("kategori_id"));
			echo json_encode($get);
		}
	}

	public function get_data(){
		if(count($_GET)>0){
			 $columns = [ 
	             0 => 'customer_name',
	             1 => 'customer_wa',
	             2 => 'customer_created'
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
	       	$this->load->model('customer/CustomerModel');
	       	$data = $this->CustomerModel->getData($queryParam,$columns,$search);
	        $return = [];
        	$resp['draw'] = (int)$this->input->get('draw');
        	$temp_data = array();
        	foreach ($data['data'] as $dt) {
        		$p = array(
        			"customer_name" => $dt['customer_name'],
        			"customer_wa" => $dt['customer_wa'],
        			"customer_created" => $dt['customer_created']
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
