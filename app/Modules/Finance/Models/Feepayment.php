<?php

namespace App\Modules\Finance\Models;

use Illuminate\Database\Eloquent\Model;

class Feepayment extends Model
{
    //
    protected $table = 'feepayment';
    
    protected $fillable = ['admno', 'receiptno', 'systemno', 'bank_id', 'term', 'year', 'account_id', 'amount', 'paid_on'];
}
