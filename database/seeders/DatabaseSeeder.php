<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            TableSeeder::class,
            GameSeeder::class,
            TeamsMembersSeeder::class,
            PracticeSeeder::class,
            member_practiceSeeder::class,
            GameSeeder::class,
            BandSeeder::class,
            StaffSeeder::class,
            Band_StaffSeeder::class,
            ReserveSeeder::class,
        ]);
    }
}
