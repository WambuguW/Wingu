<?php

namespace App\Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;

class Examresults extends Model
{
    protected $table = 'examresults';
    
    protected $fillable = ['admno', 'class', 'class', 'exam', 'term', 'year', 'subjectid', 'marks', 'comments'];
}
