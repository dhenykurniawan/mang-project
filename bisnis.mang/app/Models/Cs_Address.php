<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\state\St_Kelurahan;
class Cs_Address extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $incrementing = true;

    protected $table = 'cs_address';
    protected $primaryKey = 'address_id';

    protected $fillable = [
        'address_id', 'customer_id','kelurahan_id','provinsi_name','kota_name','kecamatan_name','kelurahan_name','address_detail','address_utama'
    ];


    public function kelurahan(){
    	return $this->hasOne(St_Kelurahan::class,'kelurahan_id','kelurahan_id');
    }

   

    
}
