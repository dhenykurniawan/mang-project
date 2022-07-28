<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pr_Produk_Variant extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $incrementing = true;

    protected $table = 'pr_produk_variant';
    protected $primaryKey = 'produk_variant_id';

    protected $fillable = [
        'produk_variant_id',
        'produk_id',
        'produk_variant_nama',
        'produk_variant_shortdesc',
        'produk_variant_desc',
        'produk_variant_harga_beli',
        'produk_variant_harga_jual',
        'produk_variant_harga_promo',
        'produk_variant_status',
        'produk_variant_someday',
        'produk_variant_gambar',
        'produk_variant_createdby',
        'produk_variant_updatedby',
        'produk_variant_created',
        'produk_variant_updated'
    ];

    /**
     * Get the produk that owns the Pr_Produk_Variant
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function produk(): BelongsTo
    {
        return $this->belongsTo(Pr_Produk::class);
    }
}
