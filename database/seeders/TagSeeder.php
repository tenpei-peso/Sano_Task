<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert([
            [
                'tag' => '英語'
            ],
            [
                'tag' => '国語'
            ],
            [
                'tag' => '数学'
            ],
            [
                'tag' => '理科'
            ],
            [
                'tag' => '科学'
            ],
            [
                'tag' => '勉強'
            ],
            [
                'tag' => '駆け出しエンジニアと繋がりたい'
            ],
            [
                'tag' => '初学者'
            ],
            [
                'tag' => '初心者'
            ],
            [
                'tag' => '駆け出し'
            ],
        ]);
    }
}
