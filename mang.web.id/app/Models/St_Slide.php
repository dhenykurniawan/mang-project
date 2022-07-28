<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class St_Slide extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $incrementing = true;

    protected $table = 'st_slide';
    protected $primaryKey = 'slide_id';

    protected $fillable = [
        'slide_id', 'slide_file','slide_created'
    ];
   
    
}
