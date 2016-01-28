<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public function isActive() {
        return $this->active;
    }

    /**
     * Get the comments for the blog post.
     */
    public function users()
    {
        return $this->hasMany('App\User', 'companies_id', 'id');
    }
}
