<?php

namespace Database\Seeders;

use App\Models\ShopType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShopTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        ShopType::create([
            'name' => 'Normal'
        ]);

        ShopType::create([
            'name' => 'Online'
        ]);

        ShopType::create([
            'name' => 'Admin'
        ]);

        // ShopType::create([
        //     'name' => 'Not Active ("can\'t add offers")'
        // ]);
    }
}
