<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Account;
use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleControllerTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    function ブログが新規登録できる() {
        $article = Account::factory()->create();

        $postData = [
            'account_id' => 1,
            'study_time' => 2,
            'genre' => 'php',
            'content' => 'めっちゃいい記自',
        ];

        $this->postJson('api/create_article_data', $postData)->assertOk();
        //テーブルに作ほど登録した値があるか確認
        $this->assertDatabaseHas('articles', $postData);
    }

    /** @test */
    function ブログが編集できる() {
        $article = Article::factory()->create();
        dump($article->id);

        $postData = [
            'id' => 2,
            'account_id' => 3,
            'study_time' => 2,
            'genre' => 'php',
            'content' => 'コーヒー牛乳すこ',
        ];

        $this->postJson('api/update_article_data', $postData)->assertOk();
        //テーブルに作ほど登録した値があるか
        $this->assertDatabaseHas('articles', $postData);
        //新規にデータが追加されていないか
        $this->assertCount(1, Article::all());
    }

    /** @test */
    function ブログが削除できる() {
        $article = Article::factory()->create();
        dump($article);
        $postData = [
            'id' => 3
        ];

        $this->postJson('api/delete_article_data', $postData)->assertOk();

        //新規にデータが追加されていないか
        $this->assertCount(0, Article::all());
    }
}
