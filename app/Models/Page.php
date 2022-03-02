<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    const COMPLETED_TRUE = 1;
    const COMPLETED_FALSE = 0;


    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(PageCategory::class, 'page_category_id');
    }
}
