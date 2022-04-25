<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class member_practiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('member_practice')->insert(
            [
                'member_id' => 1,
                'practice_id' => 1,
            ]);

        DB::table('member_practice')->insert(
            [
                'member_id' => 1,
                'practice_id' => 2,
            ]);

        DB::table('member_practice')->insert(
            [
                'member_id' => 1,
                'practice_id' => 3,
            ]);

        DB::table('member_practice')->insert(
            [
                'member_id' => 2,
                'practice_id' => 1,
            ]);

        DB::table('member_practice')->insert(
            [
                'member_id' => 2,
                'practice_id' => 2,
            ]);

        DB::table('member_practice')->insert(
            [
                'member_id' => 2,
                'practice_id' => 3,
            ]);
        DB::table('member_practice')->insert(
            [
                'member_id' => 3,
                'practice_id' => 3,
            ]);
        DB::table('member_practice')->insert(
            [
                'member_id' => 3,
                'practice_id' => 1,
            ]);
        DB::table('member_practice')->insert(
            [
                'member_id' => 3,
                'practice_id' => 2,
            ]);
        DB::table('member_practice')->insert(
            [
                'member_id' => 4,
                'practice_id' => 3,
            ]);
        DB::table('member_practice')->insert(
            [
                'member_id' => 4,
                'practice_id' => 2,
            ]);
        DB::table('member_practice')->insert(
            [
                'member_id' => 4,
                'practice_id' => 1,
            ]);
        DB::table('member_practice')->insert(
            [
                'member_id' => 1,
                'practice_id' => 5,
            ]);
        DB::table('member_practice')->insert(
            [
                'member_id' => 4,
                'practice_id' => 5,
            ]);
        DB::table('member_practice')->insert(
            [
                'member_id' => 5,
                'practice_id' => 5,
            ]);
    }
}