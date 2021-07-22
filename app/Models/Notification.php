<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
	protected $table = 'notification';
    protected $fillable = ['notification_type','notification_title','notification_description','customer_id'];
}