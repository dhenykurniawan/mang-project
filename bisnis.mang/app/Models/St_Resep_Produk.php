<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Pr_Produk;

class St_Resep_Produk extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $incrementing = false;

    protected $table = 'st_resep_produk';
    protected $primaryKey = 'resep_produk_id';

    protected $fillable = [
        'resep_produk_id', 'resep_id','produk_id'
    ];

    public function produk(){
        return $this->hasOne(Pr_Produk::class,'produk_id','produk_id');
    }
}
