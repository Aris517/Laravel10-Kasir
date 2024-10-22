<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $table = 'invoice';

    protected $fillable = [
        'faktur_pembelian',
        'tgl_pembelian',
        'id_diskon',
        'total',
        'id_users',
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
