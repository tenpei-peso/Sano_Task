<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use Database\Seeders\BlogSeeder;
use Database\Seeders\SecondCategorySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

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

    /** @test */
    function ブログのカテゴリー表示() {
        $this->seed(BlogSeeder::class);
        $this->seed(SecondCategorySeeder::class);

        $categoryData = Blog::find(1)->second_category->name;
        $this->getJson('api/blog_category')->assertOk()->assertJsonFragment([$categoryData]);
    }

    /** @test */
    function ブログを新規登録できる() {
        $user = User::factory()->create();
        
        $postData = [
            'user_id' => $user->id,
            'second_category_id' => 2,
            'title' => 'えいぶんについて',
            'price' => 1500,
            'content' => 'めっちゃいい説明',
        ];

        $blogCreate = $this->withHeaders(['Authorization' => 'Bearer ' . JWTAuth::fromUser($user)])->postJson('api/create_blog', $postData);
        $blogCreate->assertOk();

        $this->assertDatabaseHas('blogs', ['title' => 'えいぶんについて']); //テーブルに先ほど登録した値があるかチェック
    }

    /** @test */
    function 自分のブログは編集できる() {
        //コントローラーでログインしているユーザーとブログを作成したユーザーが一致しないとエラーを出す様にしている。
        //$userのidと$blogの'user_id'が一致している
        $user = User::factory()->create();

        //ブログのダミーデータ作成
        $blog = Blog::create([
            'user_id' => 1,
            'second_category_id' => 1,
            'title' => "テスト",
            'price' => 5555,
            'content' => 'ブログの内容です',
        ]);

        //編集のデータ
        $postData = [
            'id' => 1,
            'user_id' => 2,
            'second_category_id' => 2,
            'title' => 'えいぶんについて',
            'price' => 1500,
            'content' => 'めっちゃいい説明',
        ];
        $blogUpdate =$this->withHeaders(['Authorization' => 'Bearer ' . JWTAuth::fromUser($user)])->postJson('api/update_blog/'. $blog->id, $postData);
        $blogUpdate->assertOk();
        $this->assertDatabaseHas('blogs', ['title' => 'えいぶんについて']);
        $this->assertCount(1, Blog::all()); //新規に追加されていないかチェック
    }

    /** @test */
    function 他人のブログは編集できない() {
        //コントローラーでログインしているユーザーとブログを作成したユーザーが一致しないとエラーを出す様にしている。
        //$userのidと$blogの'user_id'が一致していない
        $user = User::factory()->create();

        //ブログのダミーデータ作成
        $blog = Blog::create([
            'id' => 1,
            'user_id' => 3,
            'second_category_id' => 1,
            'title' => "テスト",
            'price' => 5555,
            'content' => 'ブログの内容です',
        ]);

        //編集のデータ
        $postData = [
            'user_id' => 2,
            'second_category_id' => 2,
            'title' => 'えいぶんについて',
            'price' => 1500,
            'content' => 'めっちゃいい説明',
        ];
        $blogUpdate =$this->withHeaders(['Authorization' => 'Bearer ' . JWTAuth::fromUser($user)])->postJson('api/update_blog/'. $blog->id, $postData);
        $blogUpdate->assertStatus(404);
    }

    /** @test */
    function 自分のブログは削除できる() {
        //コントローラーでログインしているユーザーとブログを作成したユーザーが一致しないとエラーを出す様にしている。
        //$userのidと$blogの'user_id'が一致している
        $user = User::factory()->create();

        //ブログのダミーデータ作成
        $blog = Blog::create([
            'user_id' => 1,
            'second_category_id' => 1,
            'title' => "テスト",
            'price' => 5555,
            'content' => 'ブログの内容です',
        ]);

        //編集のデータ
        $postData = [
            'id' => 1
        ];
        $blogUpdate =$this->withHeaders(['Authorization' => 'Bearer ' . JWTAuth::fromUser($user)])->postJson('api/delete_blog/'. $blog->id, $postData);
        $blogUpdate->assertOk();
        $this->assertCount(0, Blog::all()); //消えてるかチェック
    }

    /** @test */
    function 自分のブログは削除できない() {
        //コントローラーでログインしているユーザーとブログを作成したユーザーが一致しないとエラーを出す様にしている。
        //$userのidと$blogの'user_id'が一致している
        $user = User::factory()->create();

        //ブログのダミーデータ作成
        $blog = Blog::create([
            'user_id' => 3,
            'second_category_id' => 1,
            'title' => "テスト",
            'price' => 5555,
            'content' => 'ブログの内容です',
        ]);

        //編集のデータ
        $postData = [
            'id' => 1
        ];
        $blogUpdate =$this->withHeaders(['Authorization' => 'Bearer ' . JWTAuth::fromUser($user)])->postJson('api/delete_blog/'. $blog->id, $postData);
        $blogUpdate->assertOk();
        $this->assertCount(0, Blog::all()); //消えてるかチェック
    }
}
