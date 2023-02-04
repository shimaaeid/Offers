<?php

namespace App\Listeners;

use App\Events\likeOfferApi;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class updateLikes
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
    public function handle(likeOfferApi $likeOfferApi)
    {
        //
        $this->updateLike($likeOfferApi->offer);
    }

    function updateLike($offer){

        $offer->like = $offer->like +1;

        $offer->save();


    }
}
