<?php

namespace Database\Seeders;

use App\Models\Article;
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
            ArticleSeeder::class,
        ]);
    }
}
