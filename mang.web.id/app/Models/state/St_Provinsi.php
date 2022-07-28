<?php

namespace App\Models\state;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class St_Provinsi extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $incrementing = true;

    protected $table = 'st_provinsi';
    protected $primaryKey = 'provinsi_id';

    protected $fillable = [
        'provinsi_id', 'provinsi_name','provinsi_status'
    ];

    
}
