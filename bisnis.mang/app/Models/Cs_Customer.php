<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cs_Address;

class Cs_Customer extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $incrementing = true;

    protected $table = 'cs_customer';
    protected $primaryKey = 'customer_id';

    protected $fillable = [
        'customer_id',
        'customer_name',
        'customer_wa',
        'customer_email',
        'customer_nama_pic',
        'customer_jenis_usaha',
        'customer_alamat_usaha',
        'customer_jam_operasional',
        'customer_jam_pengiriman',
        'customer_created',
        'customer_updated',
    ];

    public function address()
    {
        return $this->hasMany(Cs_Address::class, 'customer_id', 'customer_id');
    }
}
