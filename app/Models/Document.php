<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{

    use HasFactory;

    protected $table = "documents";

    protected $fillable = [ 'student_id', 'document','document_name','document_type','document_status'];

}

