<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SettingModel extends CI_Model{
    public function get(){
        $data = $this->db->get("st_setting");
        $data = $data->result_array();
        return $data[0];
    }

   

}
?>