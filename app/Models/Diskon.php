<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diskon extends Model
{
    use HasFactory;

    protected $table = 'diskon';

    protected $fillable = [
        'jml_harga',
        'diskon',
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
