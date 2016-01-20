<?php

namespace App;

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
        $this->key = sha1(mt_rand());
    }

    public function isActive() {
        return $this->active;
    }
}
