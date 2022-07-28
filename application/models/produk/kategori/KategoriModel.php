<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KategoriModel extends CI_Model{

    public function getData($param,$columns,$search){
        for($i = 0; $i < count($columns); $i++){
            $value = $search[$i]['search']['value'];
            $key =  $search[$i]['data'];
            if(!empty($value)){
               $this->db->like($key, $value);
            }
        }
        $query = $this->db->from("pr_kategori");
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
                      ->get("pr_kategori");

        $dtx = array(
            "total_data" => $total_data,
            "data" => $data->result_array()
        );
        return $dtx;
    }

    public function getAll(){
         $data = $this->db->order_by("kategori_nama","ASC")->get("pr_kategori")->result_array();
         return $data;
    }

    public function store($post,$file){
        $config['upload_path']          = FCPATH.'/assets/uploads/kategori/';
        $config['allowed_types']        = 'gif|jpg|jpeg|png';
        $config['file_name']            = $file['name'];
        $config['overwrite']            = true;
        /*$config['max_size']             = 1024; // 1MB
        $config['max_width']            = 1080;
        $config['max_height']           = 1080;*/
        $this->load->library('upload', $config);
        $res = array();
        if(!$this->upload->do_upload('kategori_icon')){
            $res = array(
                "success" => 0,
                "message" => "Kesalahan format file gambar"
            );
        }
        else{
            $uploaded_data = $this->upload->data();
            $insert = array(
                "kategori_nama" => $post['kategori_name'],
                "kategori_icon" => $file['name']
            );
            $this->db->insert("pr_kategori",$insert);
             $res = array(
                "success" => 1,
                "message" => "Kategori berhasil di simpan"
            );

        }

        return $res;
    }

    public function update($post,$file){
        $res = array();
        $update = array(
            "kategori_nama" => $post['kategori_name'],
        );
        if($file['size']>0){
            $config['upload_path']          = FCPATH.'/assets/uploads/kategori/';
            $config['allowed_types']        = 'gif|jpg|jpeg|png';
            $config['file_name']            = $file['name'];
            $config['overwrite']            = true;
            /*$config['max_size']             = 1024; // 1MB
            $config['max_width']            = 1080;
            $config['max_height']           = 1080;*/
            $this->load->library('upload', $config);
            if(!$this->upload->do_upload('kategori_icon')){
                $res = array(
                    "success" => 0,
                    "message" => "Kesalahan format file gambar"
                );
                return $res;
            }
            $uploaded_data = $this->upload->data();
            $dt = $this->db->where("kategori_id",$post['kategori_id'])->get("pr_kategori")->row();
            if($dt){
                @unlink(FCPATH."/assets/uploads/kategori/".$dt->kategori_icon);
            }
            $update['kategori_icon'] = $file['name'];
        }
        $this->db->where("kategori_id",$post['kategori_id']);
        $this->db->update("pr_kategori",$update);
         $res = array(
            "success" => 1,
            "message" => "Kategori berhasil di edit"
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

    public function show($kategori_id){
         $data = $this->db->where("kategori_id",$kategori_id)->get("pr_kategori")->row();
         $res = array(
            "data" => $data
         );
         return $res;
    }

}
?>