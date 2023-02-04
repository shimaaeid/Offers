<?php

namespace Database\Seeders;

use App\Models\PackageType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        PackageType::create([
            'name' => 'Normal Package'
        ]);

        PackageType::create([
            'name' => 'Platinum Package'
        ]);

        PackageType::create([
            'name' => 'Golden Package'
        ]);
    }
}
