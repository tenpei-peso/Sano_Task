<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class ReserveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('reserves')->insert(
            [
                [
                    'studio' => 'A',
                    'band_id' => rand(1, 20),
                    'date' => '2022-05-23',
                    'start_time' => '01:00',
                    'finish_time' => '03:00',
                ],
                [
                    'studio' => 'B',
                    'band_id' => rand(1, 20),
                    'date' => '2022-05-23',
                    'start_time' => '01:00',
                    'finish_time' => '03:00',
                ],
                [
                    'studio' => 'C',
                    'band_id' => rand(1, 20),
                    'date' => '2022-05-23',
                    'start_time' => '01:00',
                    'finish_time' => '03:00',
                ],
                [
                    'studio' => 'A',
                    'band_id' => rand(1, 20),
                    'date' => '2022-05-23',
                    'start_time' => '03:00',
                    'finish_time' => '06:00',
                ],
                [
                    'studio' => 'A',
                    'band_id' => rand(1, 20),
                    'date' => '2022-05-23',
                    'start_time' => '01:00',
                    'finish_time' => '04:00',
                ],
                [
                    'studio' => 'B',
                    'band_id' => rand(1, 20),
                    'date' => '2022-05-23',
                    'start_time' => '05:00',
                    'finish_time' => '08:00',
                ],
                [
                    'studio' => 'C',
                    'band_id' => rand(1, 20),
                    'date' => '2022-05-23',
                    'start_time' => '05:00',
                    'finish_time' => '09:00',
                ],
                [
                    'studio' => 'A',
                    'band_id' => rand(1, 20),
                    'date' => '2022-05-23',
                    'start_time' => '07:00',
                    'finish_time' => '10:00',
                ],
                [
                    'studio' => 'A',
                    'band_id' => rand(1, 20),
                    'date' => '2022-05-23',
                    'start_time' => '11:00',
                    'finish_time' => '13:00',
                ],
                [
                    'studio' => 'A',
                    'band_id' => rand(1, 20),
                    'date' => '2022-05-23',
                    'start_time' => '13:01',
                    'finish_time' => '16:00',
                ],
                [
                    'studio' => 'A',
                    'band_id' => rand(1, 20),
                    'date' => '2022-05-23',
                    'start_time' => '16:00',
                    'finish_time' => '21:00',
                ],
                [
                    'studio' => 'B',
                    'band_id' => rand(1, 20),
                    'date' => '2022-05-24',
                    'start_time' => '05:00',
                    'finish_time' => '08:00',
                ],
                [
                    'studio' => 'C',
                    'band_id' => rand(1, 20),
                    'date' => '2022-05-26',
                    'start_time' => '05:00',
                    'finish_time' => '09:00',
                ],
                [
                    'studio' => 'A',
                    'band_id' => rand(1, 20),
                    'date' => '2022-05-28',
                    'start_time' => '07:00',
                    'finish_time' => '10:00',
                ],
                [
                    'studio' => 'A',
                    'band_id' => rand(1, 20),
                    'date' => '2022-05-29',
                    'start_time' => '11:00',
                    'finish_time' => '13:00',
                ],
                [
                    'studio' => 'A',
                    'band_id' => rand(1, 20),
                    'date' => '2022-05-30',
                    'start_time' => '13:01',
                    'finish_time' => '16:00',
                ],
                [
                    'studio' => 'A',
                    'band_id' => rand(1, 20),
                    'date' => '2022-06-2',
                    'start_time' => '16:00',
                    'finish_time' => '21:00',
                ],
            ]
        );
    }
}
