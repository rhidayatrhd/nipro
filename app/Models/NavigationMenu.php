<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NavigationMenu extends Model
{
    use HasFactory;
    // protected $table = 'navigations';
    protected $fillable = [
        'name',
        'url',
        'icon',
        'main_menu'
    ];
}
