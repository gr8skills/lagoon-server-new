<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainMenu extends Model
{
    use HasFactory;

    protected $fillable = ['caption','image'];

    public function submenu()
    {
        return $this->hasMany(SubMenu::class, 'menu_id');
    }
}
