<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SuratJalanModel extends CI_Model{

    public function surat_jalan_id() 
    {
        $tgl = date("ym"); //date(Ymd) : jika mau tahun 4 digit
        $this->db->select('RIGHT(sj_id,4) as kode', FALSE);
        $this->db->order_by('sj_created', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('tr_surat_jalan');
        if($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        }
        else {
            $kode = 1;
        }

        $kodemax = date('ym', strtotime($tgl)) . str_pad($kode, 4, 0, STR_PAD_LEFT); 
        $kodejadi = "SJ.". $kodemax;

        return $kodejadi;
    }

    public function getData($param,$columns,$search){
        for($i = 0; $i < count($columns); $i++){
            $value = $search[$i]['search']['value'];
            $key =  $search[$i]['data'];
            if(strlen($value)>0){
               if($key=="sj_tanggal"){
                 $this->db->where($key, $value);
               }
               else{
                 $this->db->like($key, $value);
               }
            }
        }
        $this->db->select("tr_surat_jalan.sj_id,
                           tr_surat_jalan.sj_tanggal,
                           mt_kurir.kurir_nama,
                           tr_surat_jalan.sj_total");
        $this->db->join('mt_kurir', 'tr_surat_jalan.kurir_id = mt_kurir.kurir_id');
        $this->db->join('tr_surat_jalan_detail', 'tr_surat_jalan.sj_id = tr_surat_jalan.sj_id');
        
        $query = $this->db->from("tr_surat_jalan");
        $total_data = $this->db->count_all_results();
        for($i = 0; $i < count($columns); $i++){
            $value = $search[$i]['search']['value'];
            
            $key =  $search[$i]['data'];
            if(strlen($value)>0){
               if($key=="sj_tanggal"){
                 $this->db->where($key, $value);
               }
               else{
                 $this->db->like($key, $value);
               }
            }
        }
      $this->db->select("tr_surat_jalan.sj_id,
                           tr_surat_jalan.sj_tanggal,
                           mt_kurir.kurir_nama,
                           tr_surat_jalan.sj_total");
        $this->db->join('mt_kurir', 'tr_surat_jalan.kurir_id = mt_kurir.kurir_id');
        $this->db->join('tr_surat_jalan_detail', 'tr_surat_jalan.sj_id = tr_surat_jalan.sj_id');
        $data = $this->db
                      ->limit($param['limit'] ?? 10,$param['page'] ?? 0)
                      ->group_by("tr_surat_jalan.sj_id")
                      ->order_by($param['order'],$param['sort'])
                      ->get("tr_surat_jalan");

        $dtx = array(
            "total_data" => $total_data,
            "data" => $data->result_array()
        );
        return $dtx;
    }

   

    public function store($post){
        $post['sj_tanggal'] = date("Y-m-d",strtotime($post['sj_tanggal']." 00:00:00"));

        $sj_total = 0;
        foreach ($post['order_id'] as $pod) {
            $this->db->where("order_id",$pod);
            $get_order = $this->db->get("tr_order")->result_array();
            if(isset($get_order[0])){
                $sj_total+=$get_order[0]['order_total'];
            }
        }
        $insert = array(
            "sj_id" => $this->surat_jalan_id(),
            "sj_tanggal" => $post['sj_tanggal'],
            "kurir_id" => $post['kurir_id'],
            "sj_keterangan" => $post['sj_keterangan'],
            "sj_total" => $sj_total,
            "sj_created" => date("Y-m-d H:i:s")
        );

        $this->db->insert("tr_surat_jalan",$insert);
        $sj_id = $insert['sj_id'];
        foreach ($post['order_id'] as $pod) {
            $insert = array(
                "sj_id" => $sj_id,
                "order_id" => $pod
            );
            $this->db->insert("tr_surat_jalan_detail",$insert);
        }


         $res = array(
            "success" => 1,
            "message" => "Surat Jalan berhasil di simpan"
        );
        return $res;
    }

    public function delete($sj_id){

         $this->db->where("sj_id",$sj_id);
         $this->db->delete("tr_surat_jalan_detail");

         $this->db->where("sj_id",$sj_id);
         $this->db->delete("tr_surat_jalan");

        
         $res = array(
            "message" => "Data berhasil di hapus"
         );
         return $res;
    }

    public function show($invoice_id){
         $data = $this->db->where("invoice_id",$invoice_id)->get("inv_invoice")->row();
         $res = array(
            "data" => $data
         );
         return $res;
    }

     public function get_print($sj_id){
         $this->db->select("tr_surat_jalan.sj_id,
                            tr_surat_jalan.sj_tanggal,
                            tr_surat_jalan.sj_total,
                            tr_surat_jalan.sj_keterangan,
                            mt_kurir.kurir_nopol,
                            mt_kurir.kurir_nama");
         $this->db->join("mt_kurir","tr_surat_jalan.kurir_id = mt_kurir.kurir_id");
         $data = $this->db->where("tr_surat_jalan.sj_id",$sj_id)->get("tr_surat_jalan")->row();


         $this->db->select("tr_order.order_id,
                            tr_order.order_nama,
                            tr_order.order_wa,
                            tr_order.order_provinsi,
                            tr_order.order_kota,
                            tr_order.order_kecamatan,
                            tr_order.order_kelurahan,
                            tr_order.order_alamat,
                            tr_order.order_keterangan,
                            tr_order.order_diskon,
                            tr_order.order_subtotal,
                            tr_order.order_ongkir,
                            tr_order.order_total");
         $this->db->join("tr_order","tr_order.order_id = tr_surat_jalan_detail.order_id");
         $data_order = $this->db
                       ->where("tr_surat_jalan_detail.sj_id",$sj_id)
                       ->get("tr_surat_jalan_detail")->result_array();

        foreach ($data_order as &$do) {
            $data_produk = array();
            $this->db->select("tr_order.order_id,
                            pr_produk.produk_nama,
                            tr_produk.trp_hargajual,
                            tr_produk.trp_qty,
                            tr_produk.trp_total");
             $this->db->join("tr_produk","tr_order.order_id = tr_produk.order_id");
             $this->db->join("pr_produk","tr_produk.produk_id = pr_produk.produk_id");
             $data_produk = $this->db->where("tr_order.order_id",$do['order_id'])->get("tr_order")->result_array();
             $do['data_produk'] = $data_produk;
        }

         $res = array(
            "data" => $data,
            "data_order" => $data_order
         );
         return $res;
    }

}
?>