<?php

namespace App\Models\transaction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Inv_Invoice extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $incrementing = false;

    protected $table = 'inv_invoice';
    protected $primaryKey = 'invoice_id';

    protected $fillable = [
        'invoice_id', 'order_id','invoice_total','invoice_created','invoice_updated'
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function(Inv_Invoice $invoice) {
            $id = "";
            $tahun = date('y');
            $bulan = date('m');
            $data = Inv_Invoice::select('invoice_id')->orderBy('invoice_created', 'DESC')->first();

            if ($data == null) {
                $id = "INV." . $tahun . $bulan . "0001";
            } else {
                if (strlen($data['invoice_id']) < 11) {
                    $id = "INV." . $tahun . $bulan . "0001";
                } else {
                    $explode = explode(".", $data['invoice_id']);
                    $getbulan = substr($explode[1], 2, 2);
                    
                    if ($bulan == $getbulan) {

                        $lastCode = substr($explode[1], 4, 6) + 1;
                        $newCode = "";

                        if (strlen($lastCode) == 1) {
                            $newCode = "000".$lastCode;
                        } else  if (strlen($lastCode) == 2) {
                            $newCode = "00".$lastCode;
                        } else  if (strlen($lastCode) == 3) {
                            $newCode = "0".$lastCode;
                        } 
                        else {
                            $newCode = $lastCode;
                        }
                        
                        $id = "INV." . $tahun . $bulan . $newCode;
                    } else {
                        $id = "INV." . $tahun . $bulan . "0001";
                    }
                }
            }


            $invoice->invoice_id = $id;
            return true;
        });
    }
}
