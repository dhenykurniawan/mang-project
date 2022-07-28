<?php

namespace App\Models\state;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class St_Kecamatan extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $incrementing = true;

    protected $table = 'st_kecamatan';
    protected $primaryKey = 'kecamatan_id';

    protected $fillable = [
        'kecamatan_id','kecamatan_kota_id', 'kecamatan_name','kecamatan_status'
    ];

    
}
