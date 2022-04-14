<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;



class MemberController extends Controller
{
    public function showMemberList(Member $member, $area = null) {
        $fetchIdUser = $member->getIdUser(); //04 step3
        $fetchAreaUser = $member->getAreaUser(); //04 step4
        $fetchAgeUser = $member->getAgeUser(); //04 step5


        $allMember = $member::all();  //05 step1
        $tokyoUser = $allMember->firstWhere('area','東京'); //05 step2
        $ageTwentyFive = $allMember->where('age', '>=', 25); //05 step3

        $ageHasData = $allMember->where('age', '<=', 20)->isNotEmpty(); //05 step4

        if($ageHasData) {
            // Log::info("２０歳以下がいます");
        } else {
            // Log::info("いません");
        }

        $memberCount = $allMember->count();  //05 step5

        $tokyoMembers = $allMember->map(function($item) {  //05 step6
            if ($item['area'] == '東京') {
                return $item;
            }
        });

        $areaData = $allMember->pluck('area');  //05 step7

        $sortMembers = $allMember->sortByDesc('age');  //05 step8

        // Log::info($sortMembers);

        //<------  07 step3 ---------->
        $emptyData = Member::where('area', $area)->get()->isNotEmpty();

        if (empty($area)) {     
            $memberUser = Member::all();
            Log::info(json_encode($memberUser, JSON_UNESCAPED_UNICODE));
        } elseif ($emptyData) {
            $memberUser = Member::where('area', $area)->get();
            Log::info(json_encode($memberUser, JSON_UNESCAPED_UNICODE));
        } elseif (!$emptyData) {
            Log::info('該当するユーザーはいません');
        }

        return 'test';
    }

    public function show($id)
    {

        $getUsers = Member::find($id); //07 step1 URLから該当するユーザー取得

        return $getUsers;
    }

    public function index() {   //07 step2 ユーザー全部表示
        $allMember = Member::all();
        return $allMember;
    }

    public function searchMembers(Request $request) {
        $minAgeData = $request->input('minAge'); 
        $maxAgeData = $request->input('maxAge'); //07 step4

        
        $selectUser = Member::where('age', '>=', $minAgeData)->get();// 07 step5

        //<-------07 step6 ------>

        if (!empty($minAgeData) && !empty($maxAgeData)) {
            $ageUser = Member::whereBetween('age', [$minAgeData, $maxAgeData])->get();
        } elseif(empty($maxAgeData)) {
            $ageUser = Member::where('age', '>=', $minAgeData)->get();
        } elseif(empty($minAgeData) && empty($maxAgeData)) {
            $ageUser = Member::all();
        }
        return $ageUser;
    }
// <------------リレーション 02 step2------------>
    public function getTeamMembers (Member $member) {
        $members = $member->getTeamMember();
        Log::info(json_encode($members, JSON_UNESCAPED_UNICODE));
        return 'test';
    }


}
