<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamsMembersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teams_members')->insert(
            [
                'team_id' => 1,
                'member_id' => 1,
            ]);

        DB::table('teams_members')->insert(
            [
                'team_id' => 1,
                'member_id' => 3,
            ]);

        DB::table('teams_members')->insert(
            [
                'team_id' => 2,
                'member_id' => 1,
            ]);

        DB::table('teams_members')->insert(
            [
                'team_id' => 1,
                'member_id' => 7,
            ]);

        DB::table('teams_members')->insert(
            [
                'team_id' => 3,
                'member_id' => 1,
            ]);

        DB::table('teams_members')->insert(
            [
                'team_id' => 100,
                'member_id' => 1,
            ]);
    }
}
