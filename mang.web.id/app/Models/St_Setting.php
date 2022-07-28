<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class St_Setting extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $incrementing = true;

    protected $table = 'st_setting';
    protected $primaryKey = 'setting_id';

    protected $fillable = [
        'setting_id', 'setting_free_ongkir','setting_free_ongkir_min','setting_timefrom_someday','setting_timeto_someday','setting_no_wa','setting_alamat'
    ];

   

    
}
