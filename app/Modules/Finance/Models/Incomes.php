<?php

namespace App\Modules\Finance\Models;

use Illuminate\Database\Eloquent\Model;

class Incomes extends Model
{
    //
    protected $table = 'incomes';
    
    protected $fillable = ['paid_by', 'receiptno', 'account_id', 'term', 'year', 'amount', 'bank_id', 'description', 'date', 'status'];
}
