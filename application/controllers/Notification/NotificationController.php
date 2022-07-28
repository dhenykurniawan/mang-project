<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NotificationController extends CI_Controller {

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
	public function get_count()
	{
		$count = $this->db->where("notif_read","0")->get("us_notif")->num_rows();
		$res = array(
			"count" => $count
		);
		echo json_encode($res);
	}

	public function get_detail()
	{
		$data = $this->db->where("notif_read","0")
				->order_by("notif_id","DESC")
				->get("us_notif")->result_array();
		$res = array(
			"data" => $data
		);
		echo json_encode($res);
	}

	public function read_notif()
	{
		$data = $this->db->where("notif_id",$this->input->get("notif_id"))
				->order_by("notif_id","DESC")
				->get("us_notif")->result_array();

		$param = array(
			"notif_read" => 1
		);
		$this->db->where("notif_id",$this->input->get("notif_id"));
		$this->db->update("us_notif",$param);

		redirect(base_url()."transaksi/order?order_id=".$data[0]['notif_conid']);
	}

	

}
