<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KecamatanModel extends CI_Model{

    public function get() 
    {
        $data =  $this->db->get("st_kecamatan")->result_array();  
        return $data;
    }

    public function getByKota($kota_id) 
    {
        $data =  $this->db->where("kecamatan_kota_id",$kota_id)->get("st_kecamatan")->result_array();  
        return $data;
    }
}
?>