<?php

namespace App\Model;

use Bow\Auth\Authentication as Model;
use Bow\Database\Collection;

class User extends Model
{
    /**
     * The list of hidden field when toJson is called
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    /**
     * Get user bookmark
     * 
     * @return Collection
     */
    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class, 'user_id');
    }

    /**
     * Generate the authentification token
     * 
     * @return \Policier\Token
     */
    public function generateToken()
    {
        return policier()->encode($this->id, [
            'id' => $this->id,
            'name' => $this->name
        ]);
    }

    /**
     * Verifiy token
     * 
     * @param boolean
     */
    public function verifyToken()
    {
        $token = policier()->getToken();

        return $this->id == $token['claims']['id'];
    }
}
