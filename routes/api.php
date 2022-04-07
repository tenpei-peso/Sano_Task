<?php

use App\Http\Controllers\MemberController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/member_list', [MemberController::class, 'showMemberList']);