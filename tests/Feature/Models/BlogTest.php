<?php

namespace Tests\Feature\Models;

use App\Models\Blog;
use App\Models\User;
use Database\Seeders\BlogSeeder;
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
}
