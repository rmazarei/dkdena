<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomUser extends User
{
    protected $connection = 'dkdena_comment';
    protected $table = 'users';
}
