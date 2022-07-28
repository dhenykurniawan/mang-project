<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StateController extends CI_Controller {

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
	public function get_kecamatan()
	{
		$kota_id = $this->input->post("kota_id");
		$this->load->model("state/KecamatanModel");
		$data_kecamatan = $this->KecamatanModel->getByKota($kota_id);
		echo json_encode($data_kecamatan);

	}

	public function get_kelurahan()
	{
		$kecamatan_id = $this->input->post("kecamatan_id");
		$this->load->model("state/KelurahanModel");
		$data_kelurahan = $this->KelurahanModel->getByKecamatan($kecamatan_id);
		echo json_encode($data_kelurahan);
	}

	

}
