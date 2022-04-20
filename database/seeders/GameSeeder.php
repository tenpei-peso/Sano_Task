<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('games')->insert(
            [
                'name' => "京セラドーム",
                'genre' => "サッカー",
                'date' => '20220418',
                'start_time' => '18:16',
                'finish_time' => '20:20',
            ]);
        DB::table('games')->insert(
            [
                'name' => "大阪城",
                'genre' => "サッカー",
                'date' => '20220420',
                'start_time' => '15:25',
                'finish_time' => '18:16',
            ]);
        DB::table('games')->insert(
            [
                'name' => "玉造競技場",
                'genre' => "野球",
                'date' => '20220318',
                'start_time' => '16:16',
                'finish_time' => '22:20',
            ]);
        DB::table('games')->insert(
            [
                'name' => "東京ドーム",
                'genre' => "ラクロス",
                'date' => '20220218',
                'start_time' => '12:16',
                'finish_time' => '16:20',
            ]);
        DB::table('games')->insert(
            [
                'name' => "卵競技場",
                'genre' => "ラグビー",
                'date' => '20220318',
                'start_time' => '13:16',
                'finish_time' => '14:20',
            ]);
    }
}
