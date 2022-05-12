<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWTControllerTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    function ユーザー登録() {
        $postData = [
            'name' => 'ところてん',
            'email' => 'test111@gmail.com',
            'password' => '12345678',
            'password_confirmation' => '12345678',
        ];

        $this->postJson('api/auth/register', $postData)->assertStatus(201); 
        $this->assertDatabaseHas('users', ['name' => 'ところてん']); //テーブルに先ほど登録した値があるかチェック
    }

    /** @test */
    function ログイン処理() {
        $user = User::factory()->create([
            'email' => 'test111@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        $loginData = [
            'email' => 'test111@gmail.com',
            'password' => '12345678',
        ];

        $loginUser = $this->postJson('api/auth/login', $loginData);

        $loginUser->assertOk();
        $this->assertAuthenticatedAs($user); //ログインしてるかどうか
    }

    /** @test */
    function ゲストはプロフィール見れない() {
        $this->postJson('api/auth/profile')->assertStatus(401);
    }

    /** @test */
    function ログイン中のユーザー確認() {
        $user = User::factory()->create([
            'email' => 'test111@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        // jwtトークンをheaderにつけて送らないとguardによってエラー出る。
        $userData = $this->withHeaders(['Authorization' => 'Bearer ' . JWTAuth::fromUser($user)])->postJson('api/auth/profile');
        $userData->assertOk();

        //JsonResponse型はgetOriginalContentとすると値取れる
        $getEmail = $userData->getOriginalContent()->email;
        $userData->assertJsonFragment(['email' => $getEmail]);

        //----------なぜかエラー出る actingAsが使えないーーーーーーーー
        // $this->actingAs($user)->postJson('api/auth/profile')->assertOk()->assertJsonFragment(['email' => 'test111@gmail.com']);
    }

    /** @test */
    function ログアウトできる() {
        $user = User::factory()->create();

        // jwtトークンをheaderにつけて送らないとguardによってエラー出る。
        $userData = $this->withHeaders(['Authorization' => 'Bearer ' . JWTAuth::fromUser($user)])->postJson('api/auth/logout');
        $userData->assertOk()->assertJsonFragment(['ログアウトしました']);
        $this->assertGuest();

        //----------なぜかエラー出る actingAsが使えないーーーーーーーー
        // $user = User::factory()->create();
        // $this->actingAs($user)->post('api/auth/logout')->assertOk();
    }

}
