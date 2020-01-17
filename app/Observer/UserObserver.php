<?php


namespace App\Observer;


use App\User;

class UserObserver
{
    public function creating(User $user){
        $user->email_token = str_random(10);
        $user->email_active = false;
    }
}
