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
        $scheme = 'https://';
        if (config('app.debug')) {
            $scheme = 'http://';
        }

        return $scheme . $this->domain . '/auth/callback?token=' . Auth::user()->getToken(['app' => $this->domain, 'pub' => $this->public_token]);
    }
}
