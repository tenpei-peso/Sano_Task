<?php

use App\Http\Controllers\BandController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\PracticeController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\ReserveController;
use App\Http\Controllers\StaffController;
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

//<----------沼田さん課題-------->
Route::get('/band_list_with_staff', [BandController::class, 'bandWithStaff']);
Route::get('/staff_list_with_band', [StaffController::class, 'staffWithBand']);

Route::post('/staff_create', [StaffController::class, 'staffCreate']);
Route::post('/staff_update', [StaffController::class, 'staffUpdate']);
Route::post('/staff_delete', [StaffController::class, 'staffDelete']);

Route::post('/band_create', [BandController::class, 'bandCreate']);

Route::post('/reserve_search', [ReserveController::class, 'reserveSearch']);


