<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nasabah extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "nasabahs";
    protected $fillable = [
        'name',
    ];

    public function transaction()
    {
        return $this->hasMany(Transaction::class, 'nasabah_id', 'id');
    }
}
