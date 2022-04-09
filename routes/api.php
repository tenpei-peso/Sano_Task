<?php

use App\Http\Controllers\MemberController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/member_list', [MemberController::class, 'showMemberList']);

Route::get('/member_detail/{id}', [MemberController::class, 'show']); //chap7

Route::get('/member_detail', [MemberController::class, 'index']); //chap7

Route::post('/search_members', [MemberController::class, 'searchMembers']);