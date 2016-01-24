<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->public_token = sha1(mt_rand());
    }

    public function isActive() {
        return $this->active;
    }

    public function getEndpointUrl() {
        return 'https://' . $this->domain . '/auth/jwtgssauth?token=' . Auth::user()->getToken();
    }
}
