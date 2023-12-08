<?php

namespace App\Models\Super;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menu';
    protected $guarded = ['id'];

    public function access()
    {
        return $this->hasMany(Access::class);
    }

    public function sub_menu()
    {
        return $this->hasMany('App\Models\Super\Menu', 'is_main_menu');
    }

    public function menu()
    {
        return $this->belongsTo('App\Models\Super\Menu', 'is_main_menu');
    }

    public function controller()
    {
        return $this->hasOne('App\Models\Super\Controller');
    }
}
