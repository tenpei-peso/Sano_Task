<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use Database\Seeders\BlogSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BlogControllerTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    function ブログ情報一覧() {
        $this->seed(BlogSeeder::class);

        $this->getJson('api/blog_list')->assertOk()->assertJsonFragment(['id' => 1]);
    }

    /** @test */
    function ブログの詳細表示() {
        $this->seed(BlogSeeder::class);
        $user1 = Blog::find(1);

        $this->getJson('api/blog_list/1')->assertOk()->assertJsonFragment([$user1->title]);
    }

    /** @test */
    function ブログを書いたユーザー表示() {
        User::factory(2)->create();
        $this->seed(BlogSeeder::class);
        $userData = Blog::find(1)->user->name;

        $this->getJson('api/blog_user')->assertOk()->assertJsonFragment([$userData]);
    }
}
