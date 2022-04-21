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

//<----------基礎課題3-------->
Route::post('/create_member_data', [MemberController::class, 'createMemberData']);

Route::post('/update_member_data', [MemberController::class, 'updateMemberData']);

Route::post('/delete_member_data', [MemberController::class, 'deleteMemberData']);
//<----------基礎課題3-------->


//<----------テスト1-------->
Route::get('/team_list', [TeamController::class, 'showTeams']); 

Route::get('/team_list/{genre?}', [TeamController::class, 'selectedShowTeams']); //chap7

Route::post('/select_teams', [TeamController::class, 'searchTeam']);
//<----------テスト1-------->

//<----------リレーション-------->
Route::get('/get_team_member_data', [TeamController::class, 'getTeamMemberData']); 
//<----------リレーション-------->

//<----------基礎課題3-------->
Route::post('/create_team_data', [TeamController::class, 'createTeamData']);

Route::post('/update_team_data', [TeamController::class, 'updateTeamData']);

Route::post('/delete_team_data', [TeamController::class, 'deleteTeamData']);
//<----------基礎課題3-------->

//<----------テスト2-------->
Route::get('/game_list', [GameController::class, 'getGameListData']);

Route::post('/game_search_list', [GameController::class, 'searchGameData']);
//<----------テスト2-------->