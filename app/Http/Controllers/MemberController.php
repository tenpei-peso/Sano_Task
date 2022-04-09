<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\PostRequest;



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

    public function show($id)
    {
        $allMember = Member::all();

        $getUsers = Member::find($id); //chap7 step1 URLから該当するユーザー取得

        $errorUser = $allMember->where('area', $id)->isEmpty();

        if($errorUser) {        //chap7 step2
            return "ユーザーはいません";
        } else {
            return $allMember->where('area', $id);
        }

        return $getUsers;
    }

    public function index() {   //chap7 step2 ユーザー全部表示
        $allMember = Member::all();
        return $allMember;
    }

    public function searchMembers(Request $request) {
        $minAgeData = $request->input('minAge'); 
        $maxAgeData = $request->input('maxAge'); //chap7 step4

        $allMember = Member::all();  //chap7 step5
        $ageUser = $allMember->where('age', '>=', $minAgeData); 
        
        $ageUsers = $allMember->whereBetween('age', [$minAgeData, $maxAgeData]); // chap7 step6
        return $ageUsers;
    }
}
