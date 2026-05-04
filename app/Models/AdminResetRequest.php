<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminResetRequest extends Model
{
    use HasFactory;

    protected $fillable = ['email', 'password_baru', 'status'];
}