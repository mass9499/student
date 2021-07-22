<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
	protected $table = 'page';
    protected $fillable = [ 'page_name','page_slug','page_description'];
}