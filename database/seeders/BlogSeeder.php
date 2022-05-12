<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i<20; $i++){

            DB::table('blogs')->insert(
                [
                    'user_id' => rand(1, 2),
                    'second_category_id' => rand(1, 5),
                    'title' => "タイトル . $i",
                    'price' => rand(500, 2000),
                    'content' => 'ブログの内容です',
                ]);
        }
    }
}
