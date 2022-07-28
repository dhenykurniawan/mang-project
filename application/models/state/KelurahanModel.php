<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KelurahanModel extends CI_Model{

    public function get() 
    {
        $data =  $this->db->get("st_kelurahan")->result_array();  
        return $data;
    }

    public function getByKecamatan($kecamatan_id) 
    {
        $data =  $this->db->where("kelurahan_kec_id",$kecamatan_id)->get("st_kelurahan")->result_array();  
        return $data;
    }
}
?>