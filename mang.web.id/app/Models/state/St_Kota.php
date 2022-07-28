<?php

namespace App\Models\state;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class St_Kota extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $incrementing = true;

    protected $table = 'st_kota';
    protected $primaryKey = 'kota_id';

    protected $fillable = [
        'kota_id','kota_provinsi_id', 'kota_name','kota_status'
    ];

    
}
