<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Reserve;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReserveControllerTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    function 予約登録の際、時間が重複すると予約ができない() {
        //データ挿入
        $data = Reserve::create([
            'studio' => 'A',
            'band_id' => 2,
            'date' => '2022-05-17',
            'start_time' => '09:00',
            'finish_time' => '12:00',
        ]);

        $data2 = Reserve::create([
            'studio' => 'A',
            'band_id' => 1,
            'date' => '2022-05-17',
            'start_time' => '15:00',
            'finish_time' => '19:00',
        ]);

        //時間重複していると挿入できない
        $postData = [
            'studio' => 'A',
            'band_id' => 1,
            'date' => '2022-05-17',
            'start_time' => '10:00',
            'finish_time' => '16:00',
        ];
        $doubleCheck = $this->postJson('api/create_reserve', $postData)->assertOk();
        //データの数が二つしかない
        $this->assertCount(2, Reserve::all());
        //postしたデータが存在しない
        $this->assertDatabaseMissing('reserves', $postData);

    }

    /** @test */
    function 同じスタジオで時間が重複していない場合 () {
        //データ挿入
        $data = Reserve::create([
            'studio' => 'A',
            'band_id' => 2,
            'date' => '2022-05-17',
            'start_time' => '09:00',
            'finish_time' => '12:00',
        ]);

        $data2 = Reserve::create([
            'studio' => 'A',
            'band_id' => 1,
            'date' => '2022-05-17',
            'start_time' => '15:00',
            'finish_time' => '19:00',
        ]);

        //時間重複していない
        $postData = [
            'studio' => 'A',
            'band_id' => 1,
            'date' => '2022-05-17',
            'start_time' => '13:00',
            'finish_time' => '14:00',
        ];
        $doubleCheck = $this->postJson('api/create_reserve', $postData)->assertStatus(201);
        //データの数が三つある
        $this->assertCount(3, Reserve::all());
        //postしたデータが存在する
        $this->assertDatabaseHas('reserves', $postData);
    }

    /** @test */
    function  時間が重複しているが、スタジオが違うので入れれる() {
        //データ挿入
        $data = Reserve::create([
            'studio' => 'A',
            'band_id' => 2,
            'date' => '2022-05-17',
            'start_time' => '09:00',
            'finish_time' => '12:00',
        ]);

        $data2 = Reserve::create([
            'studio' => 'A',
            'band_id' => 1,
            'date' => '2022-05-17',
            'start_time' => '15:00',
            'finish_time' => '19:00',
        ]);

        //時間重複しているがスタジオが違う
        $postData = [
            'studio' => 'B',
            'band_id' => 1,
            'date' => '2022-05-17',
            'start_time' => '09:00',
            'finish_time' => '19:00',
        ];
        $doubleCheck = $this->postJson('api/create_reserve', $postData)->assertStatus(201);
        //データの数が三つある
        $this->assertCount(3, Reserve::all());
        //postしたデータが存在する
        $this->assertDatabaseHas('reserves', $postData);
    }
}
