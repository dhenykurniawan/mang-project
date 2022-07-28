<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OrderModel extends CI_Model{

    public function order_id() 
    {
        $tgl = date("ymd"); //date(Ymd) : jika mau tahun 4 digit

        $this->db->where("MONTH(order_created)",date("Y"));
        $this->db->where("MONTH(order_created)",date("m"));
        $this->db->select('RIGHT(tr_order.order_id,4) as kode', FALSE);
        $this->db->order_by('order_id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('tr_order');
        if($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        }
        else {
            $kode = 1;
        }

        $date = date('ymd', strtotime($tgl));
        $kodemax =  str_pad($kode, 4, 0, STR_PAD_LEFT); 
        $kodejadi = "ORD.".$date.$kodemax;

        return $kodejadi;
    }

    public function getData($param,$columns,$search){
        for($i = 0; $i < count($columns); $i++){
            $value = $search[$i]['search']['value'];
            $key =  $search[$i]['data'];
            if(strlen($value)>0){
               if($key=="order_status" && $key=="order_tanggal"){
                 $this->db->where($key, $value);
               }
               else{
                 $this->db->like($key, $value);
               }
            }
        }
        $query = $this->db->from("tr_order");
        $total_data = $this->db->count_all_results();
        for($i = 0; $i < count($columns); $i++){
            $value = $search[$i]['search']['value'];
            
            $key =  $search[$i]['data'];
            if(strlen($value)>0){
               if($key=="order_status" && $key=="order_tanggal"){
                 $this->db->where($key, $value);
               }
               else{
                 $this->db->like($key, $value);
               }
            }
        }
        $data = $this->db
                      ->limit($param['limit'] ?? 10,$param['page'] ?? 0)
                      ->order_by($param['order'],$param['sort'])
                      ->get("tr_order");

        $dtx = array(
            "total_data" => $total_data,
            "data" => $data->result_array()
        );
        return $dtx;
    }

    public function getAll(){

         $data = $this->db->order_by("order_id","DESC")->get("tr_order")->result_array();
         return $data;
    }

     public function getOrderInvoice($order_id){
         $this->db->like("tr_order.order_id",$order_id);
         $this->db->where("inv_invoice.invoice_id",null);
         $this->db->select("tr_order.order_id,tr_order.order_tanggal,tr_order.order_total");
         $this->db->join('inv_invoice', 'inv_invoice.order_id = tr_order.order_id', 'left');
         $data = $this->db->order_by("tr_order.order_id","DESC")->get("tr_order")->result_array();
         return $data;
    }

     public function getOrderSuratJalan(){
         $this->db->where("tr_surat_jalan_detail.sj_id",null);
         $this->db->where("tr_order.order_status","draft");
         $this->db->select("tr_order.order_id,tr_order.order_tanggal,tr_order.order_total");
         $this->db->join('tr_surat_jalan_detail', 'tr_surat_jalan_detail.order_id = tr_order.order_id', 'left');
         $data = $this->db->order_by("tr_order.order_id","DESC")->get("tr_order")->result_array();
         return $data;
    }

    public function store($post){
        $post['order_tanggal'] = date("Y-m-d",strtotime($post['order_tanggal']." 00:00:00"));

        $provinsi_id = $post['order_provinsi'];
        $data_provinsi = $this->db->where("provinsi_id",$provinsi_id)->get("st_provinsi")->result_array();
        $post['order_provinsi'] = $data_provinsi[0]['provinsi_name'];

        $kota_id = $post['order_kota'];
        $data_kota = $this->db->where("kota_id",$kota_id)->get("st_kota")->result_array();
        $post['order_kota'] = $data_kota[0]['kota_name'];

        $kecamatan_id = $post['order_kecamatan'];
        $data_kecamatan = $this->db->where("kecamatan_id",$kecamatan_id)->get("st_kecamatan")->result_array();
        $post['order_kecamatan'] = $data_kecamatan[0]['kecamatan_name'];

        $kelurahan_id = $post['order_kelurahan'];
        $data_kelurahan = $this->db->where("kelurahan_id",$kelurahan_id)->get("st_kelurahan")->result_array();
        $post['order_kelurahan'] = $data_kelurahan[0]['kelurahan_name'];

        
        $insert = array(
            "order_id" => $this->order_id(),
            "order_subtotal" => str_replace(",", "", $post['order_subtotal']),
            "order_diskon" => str_replace(",", "", $post['order_diskon']),
            "order_total" => str_replace(",", "", $post['order_total']),
            "order_nama" => $post['order_nama'],
            "order_kelurahan_id" => $kelurahan_id,
            "order_kelurahan" => $post['order_kelurahan'],
            "order_alamat" => $post['order_alamat'],
            "order_wa" => $post['order_wa'],
            "order_ongkir" => $post['order_ongkir'],
            "order_keterangan" => $post['order_keterangan'],
            "order_status" => $post['order_status'],
            "order_tanggal" => $post['order_tanggal'],
            "order_created" => date("Y-m-d H:i:s")
        );

        $this->db->insert("tr_order",$insert);
        $index_produk = 0;
        foreach ($post['produk_id'] as $produk_id) {
            $insert_produk = array(
                "order_id" => $insert['order_id'],
                "produk_id" => $produk_id,
                "trp_hargajual" => str_replace(",", "", $post['trp_hargajual'][$index_produk]),
                "trp_qty" => str_replace(",", "", $post['trp_qty'][$index_produk]),
                "trp_diskon" => str_replace(",", "", $post['trp_diskon'][$index_produk]),
                "trp_total" => str_replace(",", "", $post['trp_total'][$index_produk]),
                "trp_hargabeli" => str_replace(",", "", $post['trp_hargabeli'][$index_produk]),
            );
           $this->db->insert("tr_produk",$insert_produk);
           $index_produk++;
        }
       
         $res = array(
            "success" => 1,
            "message" => "Order berhasil di simpan"
        );
        return $res;
    }

    public function update($post){
        $post['order_tanggal'] = date("Y-m-d",strtotime($post['order_tanggal']." 00:00:00"));
        $insert = array(
            "order_subtotal" => str_replace(",", "", $post['order_subtotal']),
            "order_diskon" => str_replace(",", "", $post['order_diskon']),
            "order_total" => str_replace(",", "", $post['order_total']),
            "order_nama" => $post['order_nama'],
            "order_alamat" => $post['order_alamat'],
            "order_wa" => $post['order_wa'],
            "order_ongkir" => $post['order_ongkir'],
            "order_keterangan" => $post['order_keterangan'],
            "order_status" => $post['order_status'],
            "order_tanggal" => $post['order_tanggal'],
            "order_created" => date("Y-m-d H:i:s")
        );
        $this->db->where("order_id",$post['order_id']);
        $this->db->update("tr_order",$insert);

        $this->db->where("order_id",$post['order_id']);
        $this->db->delete("tr_produk");
        $index_produk = 0;
        foreach ($post['produk_id'] as $produk_id) {
            $insert_produk = array(
                "order_id" => $post['order_id'],
                "produk_id" => $produk_id,
                "trp_hargajual" => str_replace(",", "", $post['trp_hargajual'][$index_produk]),
                "trp_qty" => str_replace(",", "", $post['trp_qty'][$index_produk]),
                "trp_total" => str_replace(",", "", $post['trp_total'][$index_produk]),
                "trp_hargabeli" => str_replace(",", "", $post['trp_hargabeli'][$index_produk]),
            );
           $this->db->insert("tr_produk",$insert_produk);
           $index_produk++;
        }
       
         $res = array(
            "success" => 1,
            "message" => "Order berhasil di ubah"
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

    public function show($order_id){
         $data = $this->db->
                where("order_id",$order_id)
                ->join("st_kelurahan","st_kelurahan.kelurahan_id = tr_order.order_kelurahan_id")
                ->join("st_kecamatan","st_kelurahan.kelurahan_kec_id = st_kecamatan.kecamatan_id")
                ->join("st_kota","st_kota.kota_id = st_kecamatan.kecamatan_kota_id")
                ->join("st_provinsi","st_kota.kota_provinsi_id = st_provinsi.provinsi_id")
                ->get("tr_order")->row();
         $data_produk = $this->db->where("order_id",$order_id)->get("tr_produk")->result_array();
         $res = array(
            "data" => $data,
            "data_produk" => $data_produk
         );
         return $res;
    }

}
?>