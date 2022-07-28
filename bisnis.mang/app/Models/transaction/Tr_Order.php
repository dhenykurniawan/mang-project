<?php

namespace App\Models\transaction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\transaction\Tr_Produk;

class Tr_Order extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $incrementing = false;

    protected $table = 'tr_order';
    protected $primaryKey = 'order_id';

    protected $fillable = [
        'order_id', 'customer_id','order_subtotal','order_diskon','order_total','order_nama','order_kelurahan_id','order_kelurahan','order_kecamatan','order_kota','order_provinsi','order_alamat','order_wa','order_ongkir','order_fee_ongkir','order_keterangan','order_status','order_payment_method','order_tanggal','order_created','order_updated'
    ];

    public function tr_produk(){
        return $this->hasMany(Tr_Produk::class,'order_id','order_id')->with("produk");
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function(Tr_Order $order) {
            $id = "";
            $tahun = date('y');
            $bulan = date('m');
            $data = Tr_Order::select('order_id')->orderBy('order_created', 'DESC')->first();

            if ($data == null) {
                $id = "ORD." . $tahun . $bulan . "0001";
            } else {
                if (strlen($data['order_id']) < 11) {
                    $id = "ORD." . $tahun . $bulan . "0001";
                } else {
                    $explode = explode(".", $data['order_id']);
                    $getbulan = substr($explode[1], 2, 2);
                    
                    if ($bulan == $getbulan) {

                        $lastCode = substr($explode[1], 4, 6) + 1;
                        $newCode = "";

                        if (strlen($lastCode) == 1) {
                            $newCode = "000".$lastCode;
                        } else  if (strlen($lastCode) == 2) {
                            $newCode = "00".$lastCode;
                        } else  if (strlen($lastCode) == 3) {
                            $newCode = "0".$lastCode;
                        } 
                        else {
                            $newCode = $lastCode;
                        }
                        
                        $id = "ORD." . $tahun . $bulan . $newCode;
                    } else {
                        $id = "ORD." . $tahun . $bulan . "0001";
                    }
                }
            }


            $order->order_id = $id;
            return true;
        });
    }
}
