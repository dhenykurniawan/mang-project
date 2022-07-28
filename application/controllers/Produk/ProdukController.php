<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProdukController extends CI_Controller
{

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
	public function __construct()
	{
		parent::__construct();
		$session =  $this->session->userdata("user_id");
		if ($session == null) {
			redirect(base_url());
		}
	}

	public function index()
	{
		$this->load->model('produk/kategori/KategoriModel');
		$this->load->model('produk/produk/ProdukModel');
		$kategori_data = $this->KategoriModel->getAll();
		$produk_data = $this->ProdukModel->getAll();
		$modal = [
			"kategori_data" => $kategori_data,
			"produk_data" => $produk_data
		];

		$modal_harga = $this->load->view("produk/produk/modal_harga", [], TRUE);
		$modal_form = $this->load->view("produk/produk/form", $modal, TRUE);
		$modal_form_variant = $this->load->view("produk/produk/form-variant", $modal, TRUE);
		$modal_form_variant_edit = $this->load->view("produk/produk/form-variant-edit", $modal, TRUE);

		$ct = [
			"form" => $modal_form,
			"form_variant" => $modal_form_variant,
			"form_variant_edit" => $modal_form_variant_edit,
			"modal_harga" => $modal_harga
		];
		$content = $this->load->view("produk/produk/index", $ct, TRUE);
		$dt = [
			"content" => $content
		];
		$this->load->view("layout/index", $dt);
	}

	public function store()
	{
		if (count($_POST) > 0) {
			$this->form_validation->set_rules('kategori_id', 'Kategori ID', 'required');
			$this->form_validation->set_rules('produk_nama', 'Produk Nama', 'required');
			$this->form_validation->set_rules('produk_shortdesc', 'Produk short desc', 'required');
			if (empty($_FILES['produk_gambar']['name'])) {
				$this->form_validation->set_rules('produk_gambar', 'Document', 'required');
			}
			if ($this->form_validation->run() == false) {
				$resp = array(
					"success" => 0,
					"message" => "Form bertanda * wajib di isi"
				);
				echo json_encode($resp);
				exit;
			} else {
				$this->load->model('produk/produk/ProdukModel');
				$store = $this->ProdukModel->store($this->input->post(), $_FILES['produk_gambar']);
				echo json_encode($store);
				exit;
			}
		}
	}

	public function store_variant()
	{
		if (count($_POST) > 0) {
			/** Membuat validasi form produk id */
			$this->form_validation->set_rules('produk_id', 'Produk', 'required');

			/** Mengecek data variant */
			$variants = array_values($this->input->post()['variant']);
			foreach ($variants as $variant) {
				if(
					trim($variant['nama']) == '' ||
					trim($variant['harga_biasa']) == '' ||
					trim($variant['harga_bisnis']) == '' ||
					$this->form_validation->run() == false
				) {
					$resp = [
						"success" => 0,
						"message" => "Form bertanda * wajib di isi"
					];
					echo json_encode($resp);
					exit;
				}
			}

			$this->load->model('produk/variant/VariantModel');
			$store = $this->VariantModel->store($this->input->post());
			echo json_encode($store);
			exit;
		}
	}

	public function store_harga()
	{
		if (count($_POST) > 0) {
			$this->form_validation->set_rules('harga_beli', 'Harga Beli', 'required');
			$this->form_validation->set_rules('harga_jual', 'Harga Jual', 'required');
			$this->form_validation->set_rules('harga_desc', 'Harga desc', 'required');

			if ($this->form_validation->run() == false) {
				$resp = array(
					"success" => 0,
					"message" => "Form bertanda * wajib di isi"
				);
				echo json_encode($resp);
				exit;
			} else {
				$this->load->model('produk/produk/ProdukModel');
				$store = $this->ProdukModel->store_harga($this->input->post());
				echo json_encode($store);
				exit;
			}
		}
	}

	public function update()
	{
		if (count($_POST) > 0) {
			$this->form_validation->set_rules('kategori_id', 'Kategori ID', 'required');
			$this->form_validation->set_rules('produk_nama', 'Produk Nama', 'required');
			$this->form_validation->set_rules('produk_shortdesc', 'Produk short desc', 'required');

			if ($this->form_validation->run() == false) {
				$resp = array(
					"success" => 0,
					"message" => "Form bertanda * wajib di isi"
				);
				echo json_encode($resp);
				exit;
			} else {

				$this->load->model('produk/produk/ProdukModel');
				$store = $this->ProdukModel->update($this->input->post(), $_FILES['produk_gambar']);
				echo json_encode($store);
				exit;
			}
		}
	}

	public function update_variant()
	{
		if (count($_POST) > 0) {
			$this->load->model('produk/variant/VariantModel');
			$delete = $this->VariantModel->deleteWhereProductId($this->input->post("produk_id"));
			echo $delete['success'];
		}
	}

	public function delete()
	{
		if (count($_GET) > 0) {
			$this->load->model('produk/kategori/KategoriModel');
			$get = $this->KategoriModel->delete($this->input->get("kategori_id"));
			echo json_encode($get);
		}
	}

	public function delete_variant()
	{
		if (count($_GET) > 0) {
			$this->load->model('produk/variant/VariantModel');
			$get = $this->VariantModel->delete($this->input->get("variant_id"));
			echo json_encode($get);
		}
	}

	public function show()
	{
		if (count($_GET) > 0) {
			$this->load->model('produk/produk/ProdukModel');
			$get = $this->ProdukModel->show($this->input->get("produk_id"));
			echo json_encode($get);
		}
	}

	public function show_variant()
	{
		if (count($_GET) > 0) {
			$this->load->model('produk/produk/ProdukModel');
			$get = $this->ProdukModel->show_variant($this->input->get("produk_id"));
			echo json_encode($get);
		}
	}

	public function show_harga()
	{
		if (count($_GET) > 0) {
			$this->load->model('produk/produk/ProdukModel');
			$get = $this->ProdukModel->show_harga($this->input->get("produk_id"));
			echo json_encode($get);
		}
	}

	public function get_data()
	{
		if (count($_GET) > 0) {
			$columns = [
				0 => 'pr_produk.produk_nama',
				1 => 'pr_kategori.kategori_nama',
				2 => 'pr_produk.harga_beli',
				3 => 'pr_produk.harga_jual',
				4 => 'pr_produk.harga_promo'
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
			$this->load->model('produk/produk/ProdukModel');
			$this->load->model('produk/variant/VariantModel');

			$data = $this->ProdukModel->getData($queryParam, $columns, $search);

			$return = [];
			$resp['draw'] = (int)$this->input->get('draw');
			$temp_data = array();

			foreach ($data['data'] as $dt) {
				/** Hitung jumlah variant */
				$variant = $this->VariantModel->countWhereProductId($dt['produk_id']);

				$button_edit = "<button class='btn btn-circle waves-effect waves-circle waves-float btn-warning' onclick='show_edit(" . $dt['produk_id'] . ")'><i class='material-icons'>mode_edit</i></button>";
				$button_delete = "<button class='btn  btn-circle waves-effect waves-circle waves-float btn-danger' onclick='show_delete(" . $dt['produk_id'] . ")'><i class='material-icons'>delete</i></button>";
				$button_harga = "<button class='btn  btn-circle waves-effect waves-circle waves-float btn-success' onclick='show_harga(" . $dt['produk_id'] . ")'><i class='material-icons'>attach_money</i></button>";
				$button_edit_variant = $variant > 0 ? "<button class='btn btn-circle waves-effect waves-circle waves-float btn-info' onclick='edit_variant(" . $dt['produk_id'] . ")'><i class='material-icons'>mode_edit</i></button>" : '';

				$produk_foto = "<img src='" . get_file('produk/', $dt['produk_gambar']) . "' width=50 height=50 />";

				$button_status = "<button class='btn  btn-sm  btn-success'>Aktif</button>";
				if ($dt['produk_status'] == 0) {
					$button_status = "<button class='btn  btn-sm  btn-danger'>Tidak Aktif</button>";
				}

				$button_someday = "<button class='btn  btn-sm  btn-success'>YA</button>";
				if ($dt['produk_someday'] == 0) {
					$button_someday = "<button class='btn btn-sm btn-danger'>Tidak</button>";
				}

				$p = [
					"produk_foto"    => $produk_foto,
					"produk_status"  => $button_status,
					"produk_someday" => $button_someday,
					"produk_nama"    => $dt['produk_nama'],
					"kategori_nama"  => $dt['kategori_nama'],
					"harga_beli"     => number_format($dt['harga_beli']),
					"harga_jual"     => number_format($dt['harga_jual']),
					"harga_promo"    => number_format($dt['harga_promo']),
					"button"         => "{$button_edit} {$button_harga} {$button_edit_variant}"
				];
				$temp_data[] = $p;
			}
			$resp['data'] = $temp_data;
			$resp['recordsTotal'] = count($temp_data);
			$resp['recordsFiltered'] = $data['total_data'];

			echo json_encode($resp);
		}
	}
}
