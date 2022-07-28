<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KurirModel extends CI_Model{

    public function getData($param,$columns,$search){
        for($i = 0; $i < count($columns); $i++){
            $value = $search[$i]['search']['value'];
            $key =  $search[$i]['data'];
            if(!empty($value)){
               $this->db->like($key, $value);
            }
        }
        $query = $this->db->from("mt_kurir");
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
                      ->get("mt_kurir");

        $dtx = array(
            "total_data" => $total_data,
            "data" => $data->result_array()
        );
        return $dtx;
    }

    public function getAll(){
         $data = $this->db->order_by("kurir_nama","ASC")->get("mt_kurir")->result_array();
         return $data;
    }

    public function store($post,$file){
        $config['upload_path']          = FCPATH.'/assets/uploads/kurir/';
        $config['allowed_types']        = 'gif|jpg|jpeg|png';
        $config['file_name']            = $file['name'];
        $config['overwrite']            = true;
        /*$config['max_size']             = 1024; // 1MB
        $config['max_width']            = 1080;
        $config['max_height']           = 1080;*/
        $this->load->library('upload', $config);
        $res = array();
        if(!$this->upload->do_upload('kurir_ktp')){
            $res = array(
                "success" => 0,
                "message" => "Kesalahan format file gambar"
            );
        }
        else{
            $uploaded_data = $this->upload->data();
            $insert = array(
                "kurir_nama" => $post['kurir_nama'],
                "kurir_alamat" => $post['kurir_alamat'],
                "kurir_wa" => $post['kurir_wa'],
                "kurir_nopol" => $post['kurir_nopol'],
                "kurir_created" => date("Y-m-d H:i:s"),
                "kurir_ktp" => $file['name']
            );
            $this->db->insert("mt_kurir",$insert);
             $res = array(
                "success" => 1,
                "message" => "Kurir berhasil di simpan"
            );

        }

        return $res;
    }

    public function update($post,$file){
        $res = array();
        $update = array(
            "kurir_nama" => $post['kurir_nama'],
            "kurir_alamat" => $post['kurir_alamat'],
            "kurir_wa" => $post['kurir_wa'],
            "kurir_nopol" => $post['kurir_nopol']
        );
        if($file['size']>0){
            $config['upload_path']          = FCPATH.'/assets/uploads/kurir/';
            $config['allowed_types']        = 'gif|jpg|jpeg|png';
            $config['file_name']            = $file['name'];
            $config['overwrite']            = true;
            /*$config['max_size']             = 1024; // 1MB
            $config['max_width']            = 1080;
            $config['max_height']           = 1080;*/
            $this->load->library('upload', $config);
            if(!$this->upload->do_upload('kurir_ktp')){
                $res = array(
                    "success" => 0,
                    "message" => "Kesalahan format file gambar"
                );
                return $res;
            }
            $uploaded_data = $this->upload->data();
            $dt = $this->db->where("kurir_id",$post['kurir_id'])->get("mt_kurir")->row();
            if($dt){
                @unlink(FCPATH."/assets/uploads/kurir/".$dt->kurir_ktp);
            }
            $update['kurir_ktp'] = $file['name'];
        }
        $this->db->where("kurir_id",$post['kurir_id']);
        $this->db->update("mt_kurir",$update);
         $res = array(
            "success" => 1,
            "message" => "Kurir berhasil di edit"
        );

        return $res;
    }
    
    public function delete($kategori_id){
         $dt = $this->db->where("kategori_id",$kategori_id)->get("pr_kategori")->row();
         @unlink(FCPATH."/assets/uploads/kategori/".$dt->kategori_icon);
         $this->db->where("kategori_id",$kategori_id);
         $this->db->delete("pr_kategori");
         $res = array(
            "message" => "Data berhasil di hapus"
         );
         return $res;
    }

    public function show($kurir_id){
         $data = $this->db->where("kurir_id",$kurir_id)->get("mt_kurir")->row();
         $res = array(
            "data" => $data
         );
         return $res;
    }

}
?>