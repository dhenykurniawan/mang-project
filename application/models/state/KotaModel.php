<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KotaModel extends CI_Model{

    public function get() 
    {
        $data =  $this->db->get("st_kota")->result_array();  
        return $data;
    }

    public function getByProvinsi($provinsi_id) 
    {
        $data =  $this->db->where("kota_provinsi_id",$provinsi_id)->get("st_kota")->result_array();  
        return $data;
    }
}
?>