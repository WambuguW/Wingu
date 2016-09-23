<?php

namespace App\Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;

class Studentdetails extends Model
{
    protected $table = 'studentdetails';
    
    protected $fillable = ['admno', 'fname', 'lname', 'surname', 'contact', 'address', 'dob', 'sex', 'dormitory', 'classofadm', 'currentclass', 'year', 'stream', 'admdate', 'photo'];
    
    public function studentclass()
    {
        return $this->hasMany('App\Modules\Core\Models\Studentclass');
    }
}
