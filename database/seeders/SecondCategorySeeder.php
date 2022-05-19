<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SecondCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('second_categories')->insert([
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
        ]);
    }
}
