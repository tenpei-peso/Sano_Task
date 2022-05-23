<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Band_StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i<20; $i++){

            DB::table('band_staff')->insert(
                [
                    'band_id' => rand(1, 20),
                    'staff_id' => rand(1, 20),
                ]);
        }
    }
}
