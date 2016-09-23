<?php

namespace App\Modules\Finance\Models;

use Illuminate\Database\Eloquent\Model;

class Accounts extends Model
{
    //
    protected $table = 'accounts';
    
    protected $fillable = ['accode', 'name', 'division', 'function', 'votehead', 'status'];
    
    public function accounttypes()
    {
        return $this->belongsTo('App\Modules\Finance\Models\Accounttypes');
    }
}
