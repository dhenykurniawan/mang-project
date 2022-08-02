<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OrderController extends CI_Controller {

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
		$this->load->model("transaksi/OrderModel");
		$this->load->model("produk/produk/ProdukModel");
		$this->load->model("state/ProvinsiModel");
		$this->load->model("state/KotaModel");
		$this->load->model("setting/SettingModel");

		$data_setting = $this->SettingModel->get();
		$data_provinsi = $this->ProvinsiModel->get();
		$data_kota = $this->KotaModel->getByProvinsi($data_provinsi[0]['provinsi_id']);
		$data_produk = $this->ProdukModel->getSelect();
		$modal_form_data = array(
			"data_provinsi" => $data_provinsi,
			"data_kota" => $data_kota
		);
		$modal_form = $this->load->view("transaksi/order/form",$modal_form_data,TRUE);
		$order_id_notif = $this->input->get("order_id");
		$ct = array(
			"form" => $modal_form,
			"produk_data" => $data_produk,
			"data_provinsi" => $data_provinsi,
			"data_kota" => $data_kota,
			"order_id_notif" => $order_id_notif,
			"data_setting" => $data_setting
		);
		$content = $this->load->view("transaksi/order/index",$ct,TRUE);
		$dt = array(
			"content" => $content
		);
		$this->load->view("layout/index",$dt);
	}

	public function store(){
		if(count($_POST)>0){
			$this->form_validation->set_rules('order_subtotal','Nama Kurir','required');
			$this->form_validation->set_rules('order_diskon','Alamat Kurir','required');
			$this->form_validation->set_rules('order_total','Alamat Kurir','required');
			$this->form_validation->set_rules('order_nama','Alamat Kurir','required');
			$this->form_validation->set_rules('order_alamat','Alamat Kurir','required');
			$this->form_validation->set_rules('order_wa','Alamat Kurir','required');
			$this->form_validation->set_rules('order_ongkir','Alamat Kurir','required');
			$this->form_validation->set_rules('order_status','Alamat Kurir','required');
			$this->form_validation->set_rules('order_tanggal','Alamat Kurir','required');	
			$this->form_validation->set_rules('produk_id[]',"Duration", "required");
			$this->form_validation->set_rules('trp_qty[]',"Duration", "required");
			$this->form_validation->set_rules('order_provinsi',"Duration", "required");
			$this->form_validation->set_rules('order_kota',"Duration", "required");
			$this->form_validation->set_rules('order_kecamatan',"Duration", "required");
			$this->form_validation->set_rules('order_kelurahan',"Duration", "required");
			
			
			if($this->form_validation->run() == false){
				$resp = array(
					"success" => 0,
					"message" => "Form bertanda * wajib di isi"
				);
				echo json_encode($resp);
				exit;
			}
			else{
				$this->load->model('transaksi/OrderModel');
				$store = $this->OrderModel->store($this->input->post());
				echo json_encode($store);
				exit;
			}
		}
	}

	public function update(){
		if(count($_POST)>0){
			$this->form_validation->set_rules('order_id','Nama Kurir','required');
			$this->form_validation->set_rules('order_subtotal','Nama Kurir','required');
			$this->form_validation->set_rules('order_diskon','Alamat Kurir','required');
			$this->form_validation->set_rules('order_total','Alamat Kurir','required');
			$this->form_validation->set_rules('order_nama','Alamat Kurir','required');
			$this->form_validation->set_rules('order_alamat','Alamat Kurir','required');
			$this->form_validation->set_rules('order_wa','Alamat Kurir','required');
			$this->form_validation->set_rules('order_ongkir','Alamat Kurir','required');
			$this->form_validation->set_rules('order_status','Alamat Kurir','required');
			$this->form_validation->set_rules('order_tanggal','Alamat Kurir','required');	
			$this->form_validation->set_rules('produk_id[]',"Duration", "required");
			$this->form_validation->set_rules('trp_qty[]',"Duration", "required");
			if($this->form_validation->run() == false){
				$resp = array(
					"success" => 0,
					"message" => "Form bertanda * wajib di isi"
				);
				echo json_encode($resp);
				exit;
			}
			else{
				
				$this->load->model('transaksi/OrderModel');
				$store = $this->OrderModel->update($this->input->post());
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
			$this->load->model('transaksi/OrderModel');
			$get = $this->OrderModel->show($this->input->get("order_id"));
			echo json_encode($get);
		}
	}

	public function get_order_invoice(){
		if(count($_POST)>0){
			$this->load->model('transaksi/OrderModel');
			$get = $this->OrderModel->getOrderInvoice($this->input->post("order_id"));
			echo json_encode($get);
		}
	}

	public function get_order_surat_jalan(){
		$this->load->model('transaksi/OrderModel');
		$get = $this->OrderModel->getOrderSuratJalan();
		echo json_encode($get);
	}

	public function get_data(){
		if(count($_GET)>0){
			 $columns = [ 
	             0 => 'order_id',
	             1 => 'order_nama',
	             2 => 'order_wa',
	             3 => 'order_created',
	             4 => 'order_tanggal',
	             5 => 'order_status',
							 6 => 'bonus',
	             7 => 'order_payment_method',
	             8 => 'order_total'
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
	       	$this->load->model('transaksi/OrderModel');
	       	$data = $this->OrderModel->getData($queryParam,$columns,$search);
	        $return = [];
        	$resp['draw'] = (int)$this->input->get('draw');
        	$temp_data = array();
        	foreach ($data['data'] as $dt) {
        	$button = "";
        	$button_edit = "";
					$total = "Rp.".number_format($dt['order_total']);
					$txt_wa= ", Saya Admin Mang, ingin memastikan perihal pembayaran dengan nomer order: *{$dt['order_id']}* dengan total pembayaran sebesar: *{$total}*. Harap untuk segera melunasinya. Terimakasih! ";
					$button_detail = "<button class='btn btn-circle waves-effect waves-circle waves-float btn-primary' onclick='show_detail(`".$dt['order_id']."`)'><i class='material-icons'>search</i></button> ";
					$button_wa = "<a href='https://wa.me/".wa_number($dt['order_wa'])."?text=Halo ".$dt['order_nama'].$txt_wa."' target='__blank' class='btn btn-circle waves-effect waves-circle waves-float btn-success'><i class='material-icons'>whatsapp</i></a>";
					$button_print = "<a href='".base_url().'transaksi/order/print?order_id='.$dt['order_id']."' target='__blank' class='btn btn-circle waves-effect waves-circle waves-float btn-primary'><i class='material-icons'>print</i></a>";
					$button_cancel = "";
					$button_approve = "";
					if($dt['order_status']=="draft"){
						$button_cancel = "<button data-status='cancel-admin' data-order='".$dt['order_id']."' onclick='confirm(this)'  class='btn btn-circle waves-effect waves-circle waves-float btn-danger'><i class='material-icons'>cancel</i></button>";
						$button_approve = "<button data-status='finish' data-order='".$dt['order_id']."' onclick='confirm(this)' class='btn btn-circle waves-effect waves-circle waves-float btn-success'><i class='material-icons'>check</i></button>";
						/*$button_edit = "<button class='btn btn-circle waves-effect waves-circle waves-float btn-warning'  onclick='show_edit(`".$dt['order_id']."`)'><i class='material-icons'>mode_edit</i></button>";*/
					}
				

				
				$order_status = "<button class='btn btn-small btn-primary'>Draft</span>";
				$button = $button_edit." ".$button_detail." ".$button_wa." ".$button_print." ".$button_cancel." ".$button_approve;
				if($dt['order_status'] == "approved-user"){
					$button = $button_detail;
					$order_status = "<button class='btn btn-small btn-success'>Approved User</button>";
				}
				else if($dt['order_status']=="cancel-user"){
					$button = $button_detail;
					$order_status = "<button class='btn btn-small btn-danger'>Cancel User</button>";
				}
				else if($dt['order_status']=="cancel-admin"){
					$order_status = "<button class='btn btn-small btn-danger'>Cancel Admin</button>";
				}
				else if($dt['order_status']=="approved-admin"){
					$order_status = "<button class='btn btn-small btn-success'>Approved Admin</button>";
				}
				else if($dt['order_status']=="reorder"){
					$order_status = "<button class='btn btn-small btn-warning'>Reorder</button>";
				}
				else if($dt['order_status']=="refund"){
					$order_status = "<button class='btn btn-small btn-warning'>Refund</button>";
				}
				else if($dt['order_status']=="ongoing"){
					$order_status = "<button class='btn btn-small btn-primary'>Ongoing</button>";
				}
				else if($dt['order_status']=="finish"){
					$order_status = "<button class='btn btn-small btn-success'>Finish</button>";
				}

        		$p = array(
        			"order_id" => $dt['order_id'],
        			"order_nama" => $dt['order_nama'],
        			"order_wa" => $dt['order_wa'],
        			"order_created" => $dt['order_created'],
        			"order_tanggal" => $dt['order_tanggal'],
        			"order_status" => $order_status,
        			// "bonus" => $bonus,
        			"order_payment_method" => strtoupper($dt['order_payment_method']),
        			"order_total" => number_format($dt['order_total']),
        			"button" => $button
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
		$order_id = $this->input->get("order_id");
		$this->load->model('transaksi/OrderModel');
	    $get = $this->OrderModel->show($order_id);
	    $dt_setting = $this->db->get("st_setting")->result_array();
	    $res = array(
	    	"data" => $get,
	    	"data_setting" => $dt_setting[0]

	    );
	    
	    $this->load->view("transaksi/order/print_struck",$res);
	}

	public function confirm(){
		$post = $this->input->post();
        $this->db->where("order_id",$post['order_id']);
        $this->db->update("tr_order",$post);
        $res = array(
            "success" => 1,
            "message" => "Status Order berhasil di ubah"
        );
       echo json_encode($res);

	}

	

}
