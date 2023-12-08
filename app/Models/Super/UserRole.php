<?php

namespace App\Models\Super;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserRole extends Model
{
    use HasFactory;

    protected $table = 'user_role';
    protected $guarded = ['id'];

    public function access()
    {
        return $this->hasMany(Access::class, 'user_role_id');
    }

    public function user()
    {
        return $this->hasMany(User::class, 'user_role_id');
    }
}
