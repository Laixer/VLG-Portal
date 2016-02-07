<?php

namespace App;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'note',
    ];

    /**
     * Get the phone record associated with the user.
     */
    public function type() {
        return $this->hasOne('App\UserType', 'id', 'user_type_id');
    }

    /**
     * The roles that belong to the user.
     */
    public function applications() {
        return $this->belongsToMany('App\Application')->withPivot('id', 'read', 'write');
    }

    /**
     * Get the phone record associated with the user.
     */
    public function userFunction() {
        return $this->hasOne('App\UserFunction', 'id', 'functions_id');
    }

    public function formalName() {
        return $this->name . ' ' . $this->last_name;
    }

    public function isAdmin() {
        return $this->type->group == 'admin';
    }

    public function isActive() {
        return $this->active;
    }

    public function session() {
        return $this->hasOne('App\Session', 'user_id', 'id');
    }

    public function company() {
        return $this->hasOne('App\Company', 'id', 'companies_id');
    }

    public function getToken(Array $claim = []) {
        if (count($claim) > 0)
            return JWTAuth::fromUser($this, $claim);

        return JWTAuth::fromUser($this);
    }

}
