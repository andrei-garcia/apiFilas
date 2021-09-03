<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = "payments";

    protected $fillable = [
        'invoice',
        'name_beneficiary',
        'cod_bank',
        'number_agence',
        'number_count',
        'value',
        'status',
        'bank_process'
    ];
}
