<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailInvoice extends Model
{
    use HasFactory;

    protected $table = 'detail_invoice';

    protected $fillable = [
        'id_invoice',
        'id_produk',
        'jml_produk',
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
