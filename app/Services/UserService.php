<?php

namespace App\Services;

use App\User;

class UserService
{
    private $user;

    public function __construct(User $user)
    {
        $this->user=$user;

    }

    /**
     * @return User
     */
    public function getUser($user_id)
    {
        return $this->user->where('id',$user_id)->first();
    }


}