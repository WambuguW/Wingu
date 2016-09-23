<?php

namespace App\Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;

class Subjects extends Model
{
    protected $table = 'subjects';
    
    protected $fillable = ['code', 'name'];
}
