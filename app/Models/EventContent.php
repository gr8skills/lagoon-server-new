<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventContent extends Model
{
    use HasFactory;
    use Sluggable;

    protected $guarded = ['id'];
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'header'
            ]
        ];
    }
}
