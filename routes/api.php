<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\PracticeController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\LikesController;
use Illuminate\Support\Facades\Route;

Route::get('/member_list/{area?}', [MemberController::class, 'showMemberList']);

Route::get('/member_detail/{id}', [MemberController::class, 'memberDetail']); //chap7


Route::get('/member_detail', [MemberController::class, 'index']); //chap7

Route::post('/search_members', [MemberController::class, 'searchMembers']);

//<----------基礎課題3-------->
Route::post('/create_member_data', [MemberController::class, 'createMemberData']);

Route::post('/update_member_data', [MemberController::class, 'updateMemberData']);

Route::post('/delete_member_data', [MemberController::class, 'deleteMemberData']);
//<----------基礎課題3-------->

Route::get('/team_list/{id?}', [TeamController::class, 'showTeams']); 

Route::get('/team_list/{genre?}', [TeamController::class, 'selectedShowTeams']); //chap7

Route::post('/select_teams', [TeamController::class, 'searchTeam']);
//<----------テスト1-------->

//<----------リレーション-------->
Route::get('/get_team_member_data', [TeamController::class, 'getTeamMemberData']); 
//<----------リレーション-------->

Route::post('/search_members', [MemberController::class, 'searchMembers']);

//Laravel課題3
Route::get('/practice_list/{time?}', [PracticeController::class, 'getPracticeData']); 

//Laravel課題3
Route::get('/practice_list/{time?}', [PracticeController::class, 'getPracticeData']); 

//<----------基礎課題3-------->
Route::post('/create_team_data', [TeamController::class, 'createTeamData']);

Route::post('/update_team_data', [TeamController::class, 'updateTeamData']);

Route::post('/delete_team_data', [TeamController::class, 'deleteTeamData']);
//<----------基礎課題3-------->

//<----------テスト2-------->
Route::get('/game_list', [GameController::class, 'getGameListData']);

Route::post('/game_search_list', [GameController::class, 'searchGameData']);
//<----------テスト2-------->

//<---------nisiokaMadeTask---------->
Route::get('/article_list', [ArticleController::class, 'articleListData']);
Route::get('/account_list', [AccountController::class, 'accountListData']);

Route::get('/article_list/{genre}', [ArticleController::class, 'articleGenre']);
Route::get('/article_order_study', [ArticleController::class, 'articleOrderStudy']);

Route::post('/create_article_data', [ArticleController::class, 'createArticleData']);
Route::post('/update_article_data', [ArticleController::class, 'updateArticleData']);
Route::post('/delete_article_data', [ArticleController::class, 'deleteArticleData']);

Route::post('/like', [LikesController::class, 'like']);

