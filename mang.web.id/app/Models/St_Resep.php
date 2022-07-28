<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\St_Resep_Produk;

class St_Resep extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $incrementing = false;

    protected $table = 'st_resep';
    protected $primaryKey = 'resep_id';

    protected $fillable = [
        'resep_id', 'resep_title','resep_shortdesc','resep_category','resep_untuk','resep_cover','resep_picture','resep_desc','order_kecamatan','order_kota','order_provinsi','order_alamat','order_wa','order_ongkir','resep_created','resep_updated'
    ];

    public function resep_produk(){
        return $this->hasMany(St_Resep_Produk::class,'resep_id','resep_id')->with("produk");
    }
}
