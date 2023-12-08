<?php

namespace App\Models\Super;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuController extends Model
{
    use HasFactory;

    protected $table = 'controller';
    protected $guarded = ['id'];

    public function menu()
    {
        return $this->belongsTo('App\Models\Super\Menu', 'menu_id');
    }
}
