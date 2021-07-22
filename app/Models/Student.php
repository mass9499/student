<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{

    use HasFactory;
    protected $table = "students";
    protected $fillable = ['first_name','last_name','track_id','updated_details', 'phone_number', 'email','password', 'dob', 'student_code', 'otp','admin_status','updated_at'];

}

