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
                'name' => '英語'
            ],
            [
                'name' => '国語'
            ],
            [
                'name' => '数学'
            ],
            [
                'name' => '理科'
            ],
            [
                'name' => '科学'
            ],
            [
                'name' => '勉強'
            ],
            [
                'name' => '駆け出しエンジニアと繋がりたい'
            ],
            [
                'name' => '初学者'
            ],
            [
                'name' => '初心者'
            ],
            [
                'name' => '駆け出し'
            ],
        ]);
    }
}
