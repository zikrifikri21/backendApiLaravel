<?php

namespace App\Models\Super;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Access extends Model
{
    use HasFactory;

    protected $table = 'access';
    protected $guarded = ['id'];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function user_role()
    {
        return $this->belongsTo(UserRole::class, 'user_role_id');
    }
}
