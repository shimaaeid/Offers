<?php

namespace App\Traits;

Trait ImageTrait{

    function saveImage($photo, $folder){

        // $countryFlag = $request->file('flag');
        //     $countryFlagSaveAsName =
        //         time() . $countryFlag->getClientOriginalExtension();

        //     $upload_path = 'Attachments/CountryFlag/';
        //     $country_flag_url = $upload_path . $countryFlagSaveAsName;
        //     $success = $countryFlag->move($upload_path, $countryFlagSaveAsName);

        $ImageSaveAsName =
                time() . $photo->getClientOriginalExtension();

        $image_url = $folder . $ImageSaveAsName;
        $success = $photo->move($folder, $ImageSaveAsName);
        return $image_url;

    }

}

