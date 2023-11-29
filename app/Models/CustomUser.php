<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CustomUser extends User
{
    protected $connection = 'dkdena_comment';
    protected $table = 'users';
    protected string $guard = 'comment';

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'user_id');
    }
}
