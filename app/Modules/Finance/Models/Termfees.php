<?php

namespace App\Modules\Finance\Models;

use Illuminate\Database\Eloquent\Model;

class Termfees extends Model
{
    //
    protected $table = 'termfees';
    
    protected $fillable = ['class', 'term', 'year', 'account', 'amount'];
}
