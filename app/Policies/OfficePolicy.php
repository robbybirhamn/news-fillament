<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class OfficePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the given post can be updated by the user.
     */
    public function update(User $user): Response
    {
        return $user->id == "1"
                    ? Response::allow()
                    : Response::denyWithStatus(404);
    }

    /**
     * Determine if the given post can be updated by the user.
     */
    public function office(User $user): Response
    {
        return $user->id === "1"
                    ? Response::allow()
                    : Response::denyWithStatus(404);
    }


}
