<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "transactions";
    protected $fillable = [
        'nasabah_id',
        'date',
        'description',
        'debit_credit_status',
        'amount'
    ];

    CONST DESCRIPTION_TARIK_TUNAI = "Tarik Tunai";
    CONST DESCRIPTION_SETOR_TUNAI = "Setor Tunai";
    CONST DESCRIPTION_BELI_PULSA = "Beli Pulsa";
    CONST DESCRIPTION_BAYAR_LISTRIK = "Bayar Listrik";

    CONST DEBIT = "D";
    CONST CREDIT = "C";

    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class, 'nasabah_id', 'id');
    }

    public function debit_credit_status()
    {
        $type = "";
        if($this->debit_credit_status == self::DEBIT){
            $type = "Debit";
        }
        else if($this->debit_credit_status == self::CREDIT){
            $type = "Credit";
        }
        return $type;
    }

    public function getAmountAttribute($value)
    {
        return floatval($value);
    }
}
