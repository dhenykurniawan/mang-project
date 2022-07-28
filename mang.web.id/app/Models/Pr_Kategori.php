<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pr_Kategori extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $incrementing = true;

    protected $table = 'pr_kategori';
    protected $primaryKey = 'kategori_id';
    protected $fillable = [
        'kategori_nama', 'kategori_icon'
    ];
}
