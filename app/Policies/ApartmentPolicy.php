<?php

namespace App\Policies;

use App\Apartment;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ApartmentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Apartment  $apartment
     * @return mixed
     */
    public function show(User $user, Apartment $apartment)
    {
        return $user->id === $apartment->user_id
                ? Response::allow()
                : Response::deny('Questo non è un tuo appartamento!');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function edit(User $user,  Apartment $apartment)
    {
        return $user->id === $apartment->user_id
            ? Response::allow()
            : Response::deny('Questo non è un tuo appartamento!');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Apartment  $apartment
     * @return mixed
     */
    public function update(User $user, Apartment $apartment)
    {
        return $user->id === $apartment->user_id
            ? Response::allow()
            : Response::deny('Questo non è un tuo appartamento!');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Apartment  $apartment
     * @return mixed
     */
    public function delete(User $user, Apartment $apartment)
    {
        return $user->id === $apartment->user_id
            ? Response::allow()
            : Response::deny('Questo non è un tuo appartamento!');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Apartment  $apartment
     * @return mixed
     */
    public function restore(User $user, Apartment $apartment)
    {
        return $user->id === $apartment->user_id
            ? Response::allow()
            : Response::deny('Questo non è un tuo appartamento!');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Apartment  $apartment
     * @return mixed
     */
    public function destroy(User $user, Apartment $apartment)
    {
        return $user->id === $apartment->user_id
            ? Response::allow()
            : Response::deny('Questo non è un tuo appartamento!');
    }
}