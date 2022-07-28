<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CustomerModel extends CI_Model{

    public function getData($param,$columns,$search){
        for($i = 0; $i < count($columns); $i++){
            $value = $search[$i]['search']['value'];
            $key =  $search[$i]['data'];
            if(!empty($value)){
               $this->db->like($key, $value);
            }
        }
        $query = $this->db->from("cs_customer");
        $total_data = $this->db->count_all_results();
        for($i = 0; $i < count($columns); $i++){
            $value = $search[$i]['search']['value'];
            
            $key =  $search[$i]['data'];
            if(!empty($value)){
               $this->db->like($key, $value);
            }
        }
        $data = $this->db
                      ->limit($param['limit'] ?? 10,$param['page'] ?? 0)
                      ->order_by($param['order'],$param['sort'])
                      ->get("cs_customer");

        $dtx = array(
            "total_data" => $total_data,
            "data" => $data->result_array()
        );
        return $dtx;
    }


    public function show($customer_id){
         $data = $this->db->where("customer_id",$customer_id)->get("cs_customer")->row();
         $res = array(
            "data" => $data
         );
         return $res;
    }

}
?>