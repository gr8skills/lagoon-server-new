<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandingPage extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function explore()
    {
        return $this->hasMany(LandingPageExplore::class, 'landing_id');
    }
}
