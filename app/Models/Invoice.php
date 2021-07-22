<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;


class Invoice extends Model

{

    use HasFactory;

    protected $table = "invoice";

   	protected $fillable = [

    	'invoice_number',
        'invoice_file_name',

    	'student_id',

    	'billing_date',

    	'billing_name',

    	'billing_email',
    	
    	'billi
ng_phone',
        'sub_total',
       
        'discount',
       
        'total_amount',
        
    ];

}

