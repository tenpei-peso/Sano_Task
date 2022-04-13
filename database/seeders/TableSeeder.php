<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;



class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fee = [500,1000,2000,5000];
        $rank = [1, 2, 3, 4];
        $genre = ["サッカー", "野球", "バンド", "ラグビー",];

        for($i = 0; $i<20; $i++){

            DB::table('teams')->insert(
                [
                    'name' => "name. $i",
                    'explain' => "説明. $i",
                    'genre' => Arr::random($genre),
                    'fee' => Arr::random($fee),
                    'rank' => Arr::random($rank),
                    
                ]);
        }
    }
}
