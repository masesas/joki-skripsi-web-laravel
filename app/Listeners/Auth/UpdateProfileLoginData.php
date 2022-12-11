<?php

namespace App\Listeners\Auth;

use App\Events\Auth\UserLoginSuccess;
use Carbon\Carbon;

class UpdateProfileLoginData {
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct() {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserLoginSuccess  $event
     * @return void
     */
    public function handle(UserLoginSuccess $event) {
        try {
            $user = $event->user;
            $request = $event->request;
        } catch (\Exception $e) {
            logger()->error($e);
        }

        logger('User Login Success. Name: ' . $user->name . ' | Id: ' . $user->id . ' | Email: ' . $user->email . ' | Username: ' . $user->username . ' IP:' . $request->getClientIp() . ' | UpdateProfileLoginData');
    }
}
