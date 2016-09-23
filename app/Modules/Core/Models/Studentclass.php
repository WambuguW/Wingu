<?php

namespace App\Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;

class Studentclass extends Model
{
    protected $table = 'studentclass';
    
    protected $fillable = ['admno', 'class', 'year'];
    
    public function studentdetails()
    {
        return $this->belongsTo('App\Modules\Core\Models\Studentdetails');
    }
}
