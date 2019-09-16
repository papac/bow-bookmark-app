<?php

namespace App\Model;

use Bow\Database\Barry\Model;

class Bookmark extends Model
{
    /**
     * Get the bookmark owner
     * 
     * @return User|null
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
