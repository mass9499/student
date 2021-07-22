<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Query extends Model{

    use HasFactory;
    protected $table = "queries";
   	protected $fillable = [
    	'type',
    	'user_id',
    	'admin_id',
    	'message',
    	'admin_read_status',
    	'student_read_status',
        'user_notification',
        'admin_notification'
    ];
}