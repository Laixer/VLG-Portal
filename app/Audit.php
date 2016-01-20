<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ip_address = $_SERVER['REMOTE_ADDR'];
        $this->user_agent = $_SERVER['HTTP_USER_AGENT'];
    }

    /**
     * Get the phone record associated with the user.
     */
    public function user() {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
