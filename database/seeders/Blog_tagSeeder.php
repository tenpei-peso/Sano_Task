<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Blog_tagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('blog_tag')->insert([
            [
                'blog_id' => 1,
                'tag_id' => 1
            ],
            [
                'blog_id' => 1,
                'tag_id' => 2
            ],
            [
                'blog_id' => 2,
                'tag_id' => 4
            ],
            [
                'blog_id' => 2,
                'tag_id' => 4
            ],
            [
                'blog_id' => 3,
                'tag_id' => 1
            ],
            [
                'blog_id' => 4,
                'tag_id' => 6
            ],
            [
                'blog_id' => 5,
                'tag_id' => 7
            ],
            [
                'blog_id' => 6,
                'tag_id' => 8
            ],
            [
                'blog_id' => 7,
                'tag_id' => 9
            ],
            [
                'blog_id' => 7,
                'tag_id' => 10
            ],
            [
                'blog_id' => 8,
                'tag_id' => 5
            ],
        ]);
    }
}
