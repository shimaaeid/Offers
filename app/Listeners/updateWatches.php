<?php

namespace App\Listeners;

use App\Events\visitStoreDetailsApi;
use App\Models\ShopWatches;
use App\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class updateWatches
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(visitStoreDetailsApi $visitStoreDetailsApi)
    {
        //
        $this->updateView($visitStoreDetailsApi->shop);
    }

    function updateView($shop){

        $mac = \exec('getmac');
        $mac2 = strtok($mac, ' ');

        $user = new User();
        $user->mac_add = $mac2;
        $user->save();
        // if($shop->mac_add == $user->mac_add){
        //     now()
        // }

        $shopwatchs = new ShopWatches();
        $shopwatchs->user_id = $user->id;
        $shopwatchs->shop_id = $shop->id;
        $shopwatchs->save;



        $shop->watched =  $shop->watched + 1;
        $shop->save();

    }
}
