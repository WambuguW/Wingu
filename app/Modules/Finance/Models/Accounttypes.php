<?php

namespace App\Modules\Finance\Models;

use Illuminate\Database\Eloquent\Model;

class Accounttypes extends Model
{
    //
    protected $table = 'acctypes';
    
    protected $fillable = ['name', 'description', 'function', 'division', 'code', 'status'];
    
    public function accountfunctions()
    {
        return $this->belongsTo('App\Modules\Finance\Models\Accountfunctions');
    }
    
    public function accounts()
    {
        return $this->hasMany('App\Modules\Finance\Models\Accounts');
    }
}
