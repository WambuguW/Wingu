<?php

namespace App\Modules\Finance\Models;

use Illuminate\Database\Eloquent\Model;

class Invoices extends Model
{
    //
    protected $table = 'invoices';
    
    protected $fillable = ['admno', 'invoice_no', 'invoice_date', 'description', 'invoice_amount', 'year', 'term'];
}
