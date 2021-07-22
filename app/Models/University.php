<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{

    use HasFactory;

    protected $table = "university_details";

    protected $fillable = [ 'student_id', 'application_date', 'university_name', 'application_id', 'major','intake', 'status', 'action_needed','comments', 'action_date','login_id', 'login_password','offer_letter', 'offer_letter_name'];

}

