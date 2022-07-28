<?php
defined('BASEPATH') or exit('No direct script access allowed');

class VariantModel extends CI_Model
{
	public function store($post)
	{
		$variants = array_values($post['variant']);

		$user_id = $this->session->userdata("user_id");
		$date    = date("Y-m-d H:i:s");

		foreach ($variants as $variant) {
			/** Update data */
			if(isset($post['update_variant'])) {
				$data = [
					'produk_id'         => $post['produk_id'],
					'produk_variant_id' => $variant['id'],
					'nama'              => $variant['nama'],
					'harga_biasa'       => $variant['harga_biasa'],
					'harga_bisnis'      => $variant['harga_bisnis'],
				];

				$this->update($data);
				// $this->deleteWhereProductId($post['produk_id']);
			} else {
				$insert = [
					"pr__produk_produk_id"             => $post['produk_id'],
					"produk_variant_nama"              => $variant['nama'],
					"produk_variant_harga_jual"        => $variant['harga_biasa'],
					"produk_variant_harga_jual_bisnis" => $variant['harga_bisnis'],
					"produk_variant_shortdesc"         => '',
					"produk_variant_createdby"         => $user_id,
					"produk_variant_created"           => $date
				];

				$this->db->insert("pr_produk_variant", $insert);
			}
		}

		$res = [
			"success" => 1,
			"message" => "Varian Produk berhasil di simpan"
		];

		return $res;
	}

	public function update($post)
	{
		$res = [];
		$user_id = $this->session->userdata("user_id");
		$update = [
			"pr__produk_produk_id"             => $post['produk_id'],
			"produk_variant_nama"              => $post['nama'],
			"produk_variant_harga_jual"        => $post['harga_biasa'],
			"produk_variant_harga_jual_bisnis" => $post['harga_bisnis'],
			"produk_variant_shortdesc"         => '',
			"produk_variant_updatedby"         => $user_id,
		];

		$this->db->where("produk_variant_id", $post['produk_variant_id']);
		$this->db->update("pr_produk_variant", $update);
		$res = [
			"success" => 1,
			"message" => "Varian Produk berhasil di edit"
		];
		return $res;
	}

	public function delete($id)
	{
		$this->db->where("produk_variant_id", $id);
		$this->db->delete("pr_produk_variant");
		$res = [
			"success" => 1,
			"message" => "Data berhasil di hapus"
		];

		return $res;
	}

	public function deleteWhereProductId($id)
	{
		$this->db->where("pr__produk_produk_id", $id);
		$this->db->delete("pr_produk_variant");
		$res = [
			"success" => 1,
			"message" => "Data berhasil di hapus"
		];

		return $res;
	}

	public function countWhereProductId($id)
	{
		return $this->db->where("pr__produk_produk_id", $id)->from("pr_produk_variant")->count_all_results();
	}
}
