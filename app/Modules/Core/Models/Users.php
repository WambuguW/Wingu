<?php

namespace App\Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class Users extends Model
{
    use EntrustUserTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $table = 'users';
    
    protected $fillable = [
        'name', 'username', 'email', 'password', 'role', 'active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];
    
    public function getRememberToken() {
        return null;
    }
    
    public function setAttribute($key, $value) {
        $isRememberTokenAttribute = $key == $this->getRememberToken();
        if(!$isRememberTokenAttribute){
            parent::setAttribute($key, $value);
        }
    }
}
