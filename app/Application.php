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
        return 'https://' . $this->domain . '/auth/callback?token=' . Auth::user()->getToken(['app' => $this->domain, 'pub' => $this->public_token]);
    }
}
