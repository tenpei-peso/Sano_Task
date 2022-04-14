<?php

use App\Http\Controllers\MemberController;
use App\Http\Controllers\TeamController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/member_list/{area?}', [MemberController::class, 'showMemberList']);

Route::get('/member_detail/{id}', [MemberController::class, 'show']); //chap7

Route::get('/member_detail', [MemberController::class, 'index']); //chap7

Route::post('/search_members', [MemberController::class, 'searchMembers']);
// <-------リレーション---------->
Route::get('/search_team_member', [MemberController::class, 'getTeamMembers']);


//テスト

Route::get('/team_list', [TeamController::class, 'showTeams']); 

Route::get('/team_list/{genre?}', [TeamController::class, 'selectedShowTeams']); //chap7

Route::post('/search_teams', [TeamController::class, 'searchTeams']);

Route::post('/select_fee_teams', [TeamController::class, 'searchFeeTeams']);

// <-------リレーション---------->
Route::get('/has_many_list', [TeamController::class, 'getHasManyData']); 

Route::get('/team_member_list', [TeamController::class, 'getRelationData']); 


