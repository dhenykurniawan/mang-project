<?php

namespace App\Models\transaction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pr_Produk;
class Tr_Produk extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $incrementing = true;

    protected $table = 'tr_produk';
    protected $primaryKey = 'trp_id';

    protected $fillable = [
        'trp_id', 'order_id','produk_id','trp_hargajual','trp_diskon','trp_qty','trp_total','trp_hargabeli'
    ];

     public function produk(){
        return $this->hasOne(Pr_Produk::class,'produk_id','produk_id');
    }
}
