<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pr_Produk extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $incrementing = true;

    protected $table = 'pr_produk';
    protected $primaryKey = 'produk_id';
    protected $fillable = [
        'produk_id', 'kategori_id','produk_nama','produk_shortdesc','produk_desc','harga_beli','harga_jual','harga_promo','produk_status','produk_someday','produk_gambar','produk_createdby','produk_updatedby','produk_created','produk_updated'
    ];
}
