<?php

use App\Http\Controllers\MemberController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\GameController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/member_list/{area?}', [MemberController::class, 'showMemberList']);

Route::get('/member_detail/{id}', [MemberController::class, 'memberDetail']); //chap7


Route::get('/member_detail', [MemberController::class, 'index']); //chap7

Route::post('/search_members', [MemberController::class, 'searchMembers']);

//テスト

Route::get('/team_list', [TeamController::class, 'showTeams']); 

Route::get('/team_list/{genre?}', [TeamController::class, 'selectedShowTeams']); //chap7

Route::post('/select_teams', [TeamController::class, 'searchTeam']);

Route::post('/search_members', [MemberController::class, 'searchMembers']);
//test

Route::get('/game_list', [GameController::class, 'getGameListData']);
Route::post('/game_search_list', [GameController::class, 'searchGameData']);
