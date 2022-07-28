<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthModel extends CI_Model{

    public function getAccount($user_email,$user_password){
        $data = $this->db
        		->where("user_email",$user_email)
        		->get("us_user");

        $dtx =$data->result_array();
        if(count($dtx)>0){
        	$user_passwordx = $dtx[0]['user_password'];
        	if(!password_verify($user_password,$user_passwordx)){
        		return array();
        	}
        }

        return $dtx;
    }
}
