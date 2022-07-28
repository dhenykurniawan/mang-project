<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProdukModel extends CI_Model
{

	public function getData($param, $columns, $search)
	{
		for ($i = 0; $i < count($columns); $i++) {
			$value = $search[$i]['search']['value'];
			$key =  $search[$i]['data'];
			if (!empty($value)) {
				$this->db->like($key, $value);
			}
		}
		$this->db->select("pr_produk.produk_id", "pr_produk.produk_gambar", "pr_produk.produk_someday", "pr_produk.produk_status", "pr_kategori.kategori_nama", "pr_produk.harga_beli", "pr_produk.harga_jual", "pr_produk.harga_promo");
		$this->db->join('pr_kategori', 'pr_produk.kategori_id = pr_kategori.kategori_id');
		$query = $this->db->from("pr_produk");
		$total_data = $this->db->count_all_results();
		for ($i = 0; $i < count($columns); $i++) {
			$value = $search[$i]['search']['value'];
			$key =  $search[$i]['data'];
			if (!empty($value)) {
				$this->db->like($key, $value);
			}
		}

		$this->db->select("pr_produk.produk_id,pr_produk.produk_nama,pr_produk.produk_gambar,pr_produk.produk_someday,pr_produk.produk_status,pr_kategori.kategori_nama,pr_produk.harga_beli,pr_produk.harga_jual,pr_produk.harga_promo");
		$this->db->join('pr_kategori', 'pr_produk.kategori_id = pr_kategori.kategori_id');
		$data = $this->db
			->limit($param['limit'] ?? 10, $param['page'] ?? 0)
			->order_by($param['order'], $param['sort'])
			->get("pr_produk");

		$dtx = array(
			"total_data" => $total_data,
			"data" => $data->result_array()
		);
		return $dtx;
	}

	public function getAll()
	{
		$data = $this->db->order_by("produk_nama", "ASC")->get("pr_produk")->result_array();
		return $data;
	}

	public function getSelect()
	{
		$data = $this->db->select(["produk_id", "kategori_id", "produk_nama", "harga_beli", "harga_jual", "harga_promo", "produk_status", "produk_someday", "produk_created"])->order_by("produk_nama", "ASC")->get("pr_produk")->result_array();
		return $data;
	}

	public function store($post, $file)
	{

		$config['upload_path']          = FCPATH . '/assets/uploads/produk/';
		$config['allowed_types']        = 'gif|jpg|jpeg|png';
		$config['file_name']            = "produk_" . time() . "_" . $file['name'];
		$config['overwrite']            = true;
		/*$config['max_size']             = 1024; // 1MB
        $config['max_width']            = 1080;
        $config['max_height']           = 1080;*/
		$this->load->library('upload', $config);
		$res = array();
		if (!$this->upload->do_upload('produk_gambar')) {
			$res = array(
				"success" => 0,
				"message" => "Kesalahan format file gambar"
			);
		} else {
			$user_id =  $this->session->userdata("user_id");
			$insert = array(
				"produk_nama" => $post['produk_nama'],
				"kategori_id" => $post['kategori_id'],
				"produk_shortdesc" => $post['produk_shortdesc'],
				"produk_desc" => $post['produk_desc'],
				"produk_status" => $post['produk_status'],
				"produk_someday" => $post['produk_someday'],
				"produk_gambar" => "produk_" . time() . "_" . $file['name'],
				"produk_createdby" => $user_id,
				"produk_created" => date("Y-m-d H:i:s")
			);
			$this->db->insert("pr_produk", $insert);
			$res = array(
				"success" => 1,
				"message" => "Produk berhasil di simpan"
			);
		}


		return $res;
	}

	public function store_harga($post)
	{
		$user_id =  $this->session->userdata("user_id");
		$insert = array(
			"produk_id" => $post['produk_id'],
			"harga_beli" => $post['harga_beli'],
			"harga_jual" => $post['harga_jual'],
			"harga_promo" => $post['harga_promo'],
			"harga_desc" => $post['harga_desc'],
			"harga_createdby" => $user_id
		);
		$this->db->insert("pr_harga", $insert);

		$update = array(
			"harga_beli" => $post['harga_beli'],
			"harga_jual" => $post['harga_jual'],
			"harga_promo" => $post['harga_promo'],
		);
		$this->db->where("produk_id", $post['produk_id']);
		$this->db->update("pr_produk", $update);
		$res = array(
			"success" => 1,
			"message" => "Harga Produk berhasil di simpan"
		);
		return $res;
	}

	public function update($post, $file)
	{
		$res = array();
		$user_id =  $this->session->userdata("user_id");
		$update = array(
			"produk_nama" => $post['produk_nama'],
			"kategori_id" => $post['kategori_id'],
			"produk_shortdesc" => $post['produk_shortdesc'],
			"produk_desc" => $post['produk_desc'],
			"produk_status" => $post['produk_status'],
			"produk_someday" => $post['produk_someday'],
			"produk_updatedby" => $user_id
		);

		if ($file['size'] > 0) {
			$config['upload_path']          = FCPATH . '/assets/uploads/produk/';
			$config['allowed_types']        = 'gif|jpg|jpeg|png';
			$config['file_name']            = "produk_" . time() . "_" . $file['name'];
			$config['overwrite']            = true;
			/*$config['max_size']             = 1024; // 1MB
            $config['max_width']            = 1080;
            $config['max_height']           = 1080;*/
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('produk_gambar')) {
				$res = array(
					"success" => 0,
					"message" => "Kesalahan format file gambar"
				);
				return $res;
			}
			$uploaded_data = $this->upload->data();
			$dt = $this->db->where("produk_id", $post['produk_id'])->get("pr_produk")->row();
			if ($dt) {
				@unlink(FCPATH . "/assets/uploads/produk/" . $dt->produk_gambar);
			}
			$update['produk_gambar'] = "produk_" . time() . "_" . $file['name'];
		}


		$this->db->where("produk_id", $post['produk_id']);
		$this->db->update("pr_produk", $update);
		$res = array(
			"success" => 1,
			"message" => "Produk berhasil di edit"
		);
		return $res;
	}

	public function delete($kategori_id)
	{
		$dt = $this->db->where("kategori_id", $kategori_id)->get("pr_kategori")->row();
		@unlink(FCPATH . "/assets/uploads/kategori/" . $dt->kategori_icon);
		$this->db->where("kategori_id", $kategori_id);
		$this->db->delete("pr_kategori");
		$res = array(
			"message" => "Data berhasil di hapus"
		);
		return $res;
	}

	public function show($produk_id)
	{
		$data = $this->db->where("produk_id", $produk_id)->get("pr_produk")->row();
		$res = [
			"data" => $data
		];
		return $res;
	}

	public function show_variant($produk_id)
	{
		$data = $this->db->where("pr__produk_produk_id", $produk_id)->get("pr_produk_variant")->result_array();
		$res = [
			"data" => $data
		];
		return $res;
	}

	public function show_harga($produk_id)
	{
		$data = $this->db
			->where("produk_id", $produk_id)
			->order_by("harga_id", "DESC")
			->limit(1)
			->get("pr_harga")->row();
		$table = $this->db
			->where("produk_id", $produk_id)
			->order_by("harga_id", "DESC")
			->get("pr_harga")->result_array();
		foreach ($table as &$tbl_harga) {
			$tbl_harga['harga_beli'] = number_format($tbl_harga['harga_beli']);
			$tbl_harga['harga_jual'] = number_format($tbl_harga['harga_jual']);
			$tbl_harga['harga_promo'] = number_format($tbl_harga['harga_promo']);
		}
		$res = array(
			"data" => $data,
			"table" => $table
		);
		return $res;
	}
}
