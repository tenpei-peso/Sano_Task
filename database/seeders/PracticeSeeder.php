<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;


class PracticeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('practices')->insert(
            [
                'team_id' => 1,
                'location' => "京セラドーム",
                'date' => '20220317',
                'start_time' => '15:30',
                'finish_time' => '18:00',
            ]);

        DB::table('practices')->insert(
            [
                'team_id' => 1,
                'location' => "通天閣",
                'date' => '20220319',
                'start_time' => '16:00',
                'finish_time' => '19:00',
            ]);

        DB::table('practices')->insert(
            [
                'team_id' => 2,
                'location' => "京セラドーム",
                'date' => '20220418',
                'start_time' => '15:00',
                'finish_time' => '18:00',
            ]);

        DB::table('practices')->insert(
            [
                'team_id' => 3,
                'location' => "甲子園",
                'date' => '20220510',
                'start_time' => '15:30',
                'finish_time' => '18:00',
            ]);

        DB::table('practices')->insert(
            [
                'team_id' => 4,
                'location' => "幼稚園",
                'date' => '20220601',
                'start_time' => '15:30',
                'finish_time' => '17:00',
            ]);

        DB::table('practices')->insert(
            [
                'team_id' => 4,
                'location' => "小学校",
                'date' => '20220603',
                'start_time' => '16:30',
                'finish_time' => '19:00',
            ]);
    }
    
}
