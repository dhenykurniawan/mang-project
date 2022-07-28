<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProvinsiModel extends CI_Model{

    public function get() 
    {
        $data =  $this->db->where("provinsi_status","1")->get("st_provinsi")->result_array();  
        return $data;
    }
}
?>