<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardController extends CI_Controller {

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

		$total_order = $this->db->query("SELECT COUNT(*)as total_order FROM tr_order WHERE order_status='finish'")->result_array();
		$total_produk = $this->db->query("SELECT COUNT(*)as total_produk FROM pr_produk")->result_array();
		$total_transaksi = $this->db->query("SELECT SUM(order_total)as total_transaksi FROM tr_order WHERE order_status='finish'")->result_array();
		$total_customer = $this->db->query("SELECT COUNT(*)as total_customer FROM cs_customer")->result_array();

		//chart produk terlaris
		$data_chart_produk = $this->db->query("SELECT pr_produk.produk_nama,SUM(tr_produk.trp_qty) as total 
												FROM tr_produk 
												INNER JOIN pr_produk ON tr_produk.produk_id=pr_produk.produk_id
												INNER JOIN tr_order ON tr_order.order_id=tr_produk.order_id
												WHERE tr_order.order_status = 'finish'
												GROUP BY pr_produk.produk_id
												ORDER BY SUM(tr_produk.trp_qty) DESC LIMIT 10")->result_array();
		
		
		$dt = array(
			"total_order" => $total_order[0]['total_order'],
			"total_produk" => $total_produk[0]['total_produk'],
			"total_transaksi" => $total_transaksi[0]['total_transaksi'],
			"total_customer" => $total_customer[0]['total_customer'],
			"data_chart_produk" => json_encode($data_chart_produk)
				
		);

		$content = $this->load->view("dashboard/index",$dt,TRUE);
		$dt = array(
			"content" => $content
		);
		$this->load->view("layout/index",$dt);
	}

	

}
