<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminUser extends Model
{
    use HasFactory;
    protected $table = "users";
    protected $fillable = ['name', 'email','password','mobile_no', 'dob', 'city', 'gender'];
}
