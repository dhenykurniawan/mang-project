<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InvoiceModel extends CI_Model{

    public function invoice_id() 
    {
        $tgl = date("ymd"); //date(Ymd) : jika mau tahun 4 digit

        $this->db->where("DATE(invoice_created)",date("Y-m-d"));
        $this->db->select('RIGHT(inv_invoice.invoice_id,4) as kode', FALSE);
        $this->db->order_by('invoice_id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('inv_invoice');
        if($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        }
        else {
            $kode = 1;
        }

        $kodemax = date('ymd', strtotime($tgl)) . str_pad($kode, 4, 0, STR_PAD_LEFT); 
        $kodejadi = "INV.". $kodemax;

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
        $this->db->select("inv_invoice.invoice_id","tr_order.order_id","tr_order.order_tanggal","inv_invoice.invoice_total");
        $this->db->join('tr_order', 'tr_order.order_id = inv_invoice.order_id');
        $query = $this->db->from("inv_invoice");
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
        $this->db->select("inv_invoice.invoice_id,tr_order.order_id,tr_order.order_tanggal,inv_invoice.invoice_total");
        $this->db->join('tr_order', 'tr_order.order_id = inv_invoice.order_id');
        $data = $this->db
                      ->limit($param['limit'] ?? 10,$param['page'] ?? 0)
                      ->order_by($param['order'],$param['sort'])
                      ->get("inv_invoice");

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

    public function store($post){
        $insert = array(
            "invoice_id" => $this->invoice_id(),
            "order_id" => $post['order_id'],
            "invoice_total" => str_replace(",", "", $post['invoice_total']),
            "invoice_created" => date("Y-m-d H:i:s")
        );

        $this->db->insert("inv_invoice",$insert);
         $res = array(
            "success" => 1,
            "message" => "Invoice berhasil di simpan"
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

    public function show($invoice_id){
         $data = $this->db->where("invoice_id",$invoice_id)->get("inv_invoice")->row();
         $res = array(
            "data" => $data
         );
         return $res;
    }

     public function get_print($invoice_id){
         $this->db->select("inv_invoice.invoice_id,
                            tr_order.order_id,
                            tr_order.order_nama,
                            tr_order.order_alamat,
                            tr_order.order_wa,
                            tr_order.order_subtotal,
                            tr_order.order_ongkir,
                            tr_order.order_diskon,
                            tr_order.order_total,
                            tr_order.order_keterangan,
                            tr_order.order_tanggal");
         $this->db->join("tr_order","tr_order.order_id = inv_invoice.order_id");
         $data = $this->db->where("invoice_id",$invoice_id)->get("inv_invoice")->row();

         $this->db->select("inv_invoice.invoice_id,
                            tr_order.order_id,
                            pr_produk.produk_nama,
                            tr_produk.trp_hargajual,
                            tr_produk.trp_qty,
                            tr_produk.trp_total");
         $this->db->join("tr_order","tr_order.order_id = inv_invoice.order_id");
         $this->db->join("tr_produk","tr_order.order_id = tr_produk.order_id");
         $this->db->join("pr_produk","tr_produk.produk_id = pr_produk.produk_id");
         $data_produk = $this->db->where("invoice_id",$invoice_id)->get("inv_invoice")->result_array();
         $res = array(
            "data" => $data,
            "data_produk" => $data_produk
         );
         return $res;
    }

}
?>