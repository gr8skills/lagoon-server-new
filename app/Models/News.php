<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class News extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $appends = ['excerpt', 'pretty_date'];

    public static function generateRefId()
    {
        return Str::random(32);
    }

    public function getExcerptAttribute()
    {
        return strip_tags(Str::limit($this->content, 100));
    }

    public function getPrettyDateAttribute()
    {
        return $this->created_at->toFormattedDateString();
    }
}
