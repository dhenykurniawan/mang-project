<?php

namespace App\Models\state;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class St_Kelurahan extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $incrementing = true;

    protected $table = 'st_kelurahan';
    protected $primaryKey = 'kelurahan_id';

    protected $fillable = [
        'kelurahan_id','kelurahan_kec_id', 'kelurahan_name','kelurahan_status','kelurahan_ongkir','kelurahan_feekurir_persentase'
    ];

    
}
