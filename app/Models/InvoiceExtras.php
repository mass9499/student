<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;


class InvoiceExtras extends Model

{

    use HasFactory;

    protected $table = "invoice_extras";

   	protected $fillable = [

    	'invoice_id',

    	'application_name',

    	'application_fees',

    	'service_fees',

    	'amount',
        
    	
    ];

}

