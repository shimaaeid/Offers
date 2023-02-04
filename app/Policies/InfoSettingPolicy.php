<?php

namespace App\Policies;

use App\Models\InfoSetting;
use App\Models\Shop;
use Illuminate\Auth\Access\HandlesAuthorization;

class InfoSettingPolicy
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
     * @param  \App\Models\InfoSetting  $infoSetting
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Shop $shop, InfoSetting $infoSetting)
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
     * @param  \App\Models\InfoSetting  $infoSetting
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Shop $shop, InfoSetting $infoSetting)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Shop  $shop
     * @param  \App\Models\InfoSetting  $infoSetting
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Shop $shop, InfoSetting $infoSetting)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Shop  $shop
     * @param  \App\Models\InfoSetting  $infoSetting
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Shop $shop, InfoSetting $infoSetting)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Shop  $shop
     * @param  \App\Models\InfoSetting  $infoSetting
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Shop $shop, InfoSetting $infoSetting)
    {
        //
    }
}
