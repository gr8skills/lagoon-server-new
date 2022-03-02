<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;
    const DISPLAY_SPONSOR_ON = 1;
    const DISPLAY_SPONSOR_OFF = 0;
    protected $guarded = ['id'];
}
