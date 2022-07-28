<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthController extends CI_Controller {

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
	public function login()
	{
		$session =  $this->session->userdata("user_id");
		if($session!=null){
			redirect(base_url()."dashboard/");
		}
		$this->load->view('auth/login');
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url());
	}

	public function login_post(){
		if(count($_POST)>0){
			$user_email = $this->input->post("user_email");
			$user_password = $this->input->post("user_password");
			$this->load->model('AuthModel');
			$data = $this->AuthModel->getAccount($user_email,$user_password);
			$res = array();
			if(count($data)>0){
				$res = array(
					"success" => 1,
					"message" => "Success",
					"data" => $data
				);
				$res_data = array(
					"user_id" => $data[0]['user_id'],
					"user_email" => $data[0]['user_email'],
					"user_type" => $data[0]['user_type']		
				);
				$this->session->set_userdata($res_data);
			}
			else{
				$res = array(
					"success" => 0,
					"message" => "Akun Tidak ditemukan"
				);
			}
			echo json_encode($res);
		}
	}

}
