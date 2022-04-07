<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;



class MemberController extends Controller
{
    public function showMemberList(Member $member) {
        $allMember = Member::all();  //chap6 step1
        $tokyoUser = $allMember->firstWhere('area','東京'); //chap6 step2
        $ageTwentyFive = $allMember->where('age', '>=', 25); //chap6 step3

        $ageHasData = $allMember->where('age', '<=', 20)->isNotEmpty(); //chap6 step4

        if($ageHasData) {
            Log::info("２０歳以下がいます");
        } else {
            Log::info("いません");
        }

        $memberCount = $allMember->count();  //chap6 step5

        $tokyoMembers = $allMember->map(function($items) {  //chap6 step6
            return $items->firstWhere('area','東京');
            
        });

        $areaData = $allMember->pluck('area');  //chap6 step7

        $sortMembers = $allMember->sortByDesc('age');  //chap6 step8

        Log::info($sortMembers);
        return 'test';
    }
}
