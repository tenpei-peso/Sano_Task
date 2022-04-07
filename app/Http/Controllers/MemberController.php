<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;



class MemberController extends Controller
{
    public function showMemberList(Member $member) {
        $allMember = $member->getAllUser();
        Log::info($allMember);
        return 'test';
    }
}
