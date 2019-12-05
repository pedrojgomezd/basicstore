<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    protected $fillable = ['name', 'email', 'mobile', 'password'];

    protected $hidden = ['password', 'remember_token'];

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
