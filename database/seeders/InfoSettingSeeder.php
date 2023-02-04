<?php

namespace Database\Seeders;

use App\Models\InfoSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InfoSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        InfoSetting::create([
            'forceUpdate' => '1',
            'lastBuild' => '1',
            'website' => 'benayyah.com',
            'whatsApp' =>'01124853016',
            'phone' => '01124853016',
            'snap' => 'benayyah.snapchat',
            'Instagram' => 'benayyah.instagram',
            'ticktock' => 'benayyah.ticktok',
            'policy' => 'benayyah.policy.com',
            'android' => 'benayyah.android.com',
            'ios' => 'benayyah.ios.com'
        ]);

    }
}
