<?php

namespace App\Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    /**
     *
     * @var type 
     */
    protected $table = 'classes';
    
    /**
     *
     * @var type array
     */
    protected $fillable = ['name'];
    
    /**
     * Get the streams for the class
     * 
     */
    public function streams()
    {
        return $this->hasMany('App\Modules\Core\Models\Streams');
    }
}
