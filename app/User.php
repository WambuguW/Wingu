<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use EntrustUserTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'role', 'active'
    ];
    
    protected $table = 'users';

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
