<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Us_Notif extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $incrementing = true;

    protected $table = 'us_notif';
    protected $primaryKey = 'notif_id';

    protected $fillable = [
        'notif_id', 'notif_type','notif_conid','notif_read','notif_message','notif_created'
    ];
}
