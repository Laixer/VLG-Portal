<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserFunction extends Model
{
	public $timestamps = false;

    /**
     * Get the user's first name.
     *
     * @param  string  $value
     * @return string
     */
    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }
}
