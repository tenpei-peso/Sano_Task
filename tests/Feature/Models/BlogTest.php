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
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlogTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp():void
    {
        parent::setUp();
        $this->seed(BlogSeeder::class);
        $this->seed(SecondCategorySeeder::class);
        $this->seed(TagSeeder::class);
    }


    /** @test */
    function userリレーション() {
        User::factory()->create();

        $user = Blog::find(1)->user;
        $this->assertInstanceOf(User::class, $user);
    }

    /** @test */
    function second_categoryリレーション() {
        $user = Blog::find(1)->second_category;
        $this->assertInstanceOf(SecondCategory::class, $user);
    }

    /** @test */
    function blog_tagリレーション() {
        $tag = Blog::find(1)->tags;
        $this->assertInstanceOf(Collection::class, $tag);
    }
}
