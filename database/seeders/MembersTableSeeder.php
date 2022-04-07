<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class MembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('members')->insert([
            [
                'id' => 1,
                'name' => 'demo1',
                'age' => 22,
                'area' => '大阪',
                'leader' => true,
                'comment' => 'こんにちわ',
                
            ],
            [
                'id' => 2,
                'name' => 'demo2',
                'age' => 33,
                'area' => '東京',
                'leader' => false,
                'comment' => '',
            ],
        ]);
    }
}
