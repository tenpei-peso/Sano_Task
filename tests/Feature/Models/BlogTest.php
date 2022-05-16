<?php

namespace Tests\Feature\Models;

use App\Models\Blog;
use App\Models\SecondCategory;
use App\Models\Tag;
use App\Models\User;
use Database\Seeders\Blog_tagSeeder;
use Database\Seeders\BlogSeeder;
use Database\Seeders\SecondCategorySeeder;
use Database\Seeders\TagSeeder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
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

    /** @test */
    function blog_tagリレーション() {
        $this->seed(BlogSeeder::class);
        $this->seed(TagSeeder::class);
        $this->seed(Blog_tagSeeder::class);
        
        $tag = Blog::find(1)->tags;
        $this->assertInstanceOf(Collection::class, $tag);
    }
}
