<?php

namespace GetDown;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function preferences() {
        return $this->hasOne('GetDown\Preferences');
    }

    public function templates() {
        return $this->hasMany('GetDown\Template');
    }

    public function documents() {
        return $this->hasMany('GetDown\Document');
    }
}
