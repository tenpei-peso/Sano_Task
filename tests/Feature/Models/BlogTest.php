<?php

namespace Tests\Feature\Models;

use App\Models\Blog;
use App\Models\SecondCategory;
use App\Models\User;
use Database\Seeders\BlogSeeder;
use Database\Seeders\SecondCategorySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BlogTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function userリレーション() {
        $this->seed(BlogSeeder::class);
        User::factory()->create();

        $user = Blog::find(1)->user;
        $this->assertInstanceOf(User::class, $user);
    }

    /** @test */
    function second_categoryリレーション() {
        $this->seed(BlogSeeder::class);
        $this->seed(SecondCategorySeeder::class);

        $user = Blog::find(1)->second_category;
        dump($user);
        $this->assertInstanceOf(SecondCategory::class, $user);
    }
}
