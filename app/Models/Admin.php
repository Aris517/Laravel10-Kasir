<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $table = 'admin';

    protected $fillable = [
        'id_users',
        'nama',
        'alamat',
        'no_hp',
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
