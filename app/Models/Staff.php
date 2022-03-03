<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    const IS_DIRECTOR = 1;
    const IS_NOT_DIRECTOR = 0;

    protected $fillable = [
        'name',
        'email',
        'image',
        'is_director',
    ];
}
