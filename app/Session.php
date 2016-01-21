<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
	public $timestamps = false;

    /**
     * Get the phone record associated with the user.
     */
    public function getId() {
        return $this['attributes']['id'];
    }

    /**
     * Get the phone record associated with the user.
     */
    public function user() {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    /**
     * Get the phone record associated with the user.
     */
    public function isInvalid() {
        if ($this->user) {
            return false;
        }

        if ($this->last_activity + 900 < time()) {
            return true;
        }

        return false;
    }
}
