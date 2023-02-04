<?php

namespace App\Policies;

use App\Models\Admins;
use App\Models\Shop;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Shop $shop)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Shop  $shop
     * @param  \App\Models\Admins  $admins
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Shop $shop, Admins $admins)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Shop $shop)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Shop  $shop
     * @param  \App\Models\Admins  $admins
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Shop $shop, Admins $admins)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Shop  $shop
     * @param  \App\Models\Admins  $admins
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Shop $shop, Admins $admins)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Shop  $shop
     * @param  \App\Models\Admins  $admins
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Shop $shop, Admins $admins)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Shop  $shop
     * @param  \App\Models\Admins  $admins
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Shop $shop, Admins $admins)
    {
        //
    }
}
