<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\PostRequest;



class MemberController extends Controller
{
    public function showMemberList(Member $member, $area = null) {
        $fetchIdUser = $member->getIdUser(); //04 step3
        $fetchAreaUser = $member->getAreaUser(); //04 step4
        $fetchAgeUser = $member->getAgeUser(); //04 step5

        //<----------05 step1 ------------------>
        $allMember = $member->allUser();  
        // Log::info(json_encode($allMember, JSON_UNESCAPED_UNICODE));

        //<----------05 step2 ------------------>
        $tokyoUser = $allMember->firstWhere('area','東京'); 
        // Log::info(json_encode($tokyoUser, JSON_UNESCAPED_UNICODE));

        //<----------05 step3 ------------------>
        $ageTwentyFive = $allMember->where('age', '>=', 25); 
        // Log::info(json_encode($ageTwentyFive, JSON_UNESCAPED_UNICODE));

        //<----------05 step4 ------------------>
        $ageHasData = $allMember->where('age', '<=', 20);

        if(isset($ageHasData)) {
            // Log::info(json_encode($ageHasData, JSON_UNESCAPED_UNICODE));
        } 
        if (!isset($ageHasData)) {
            // Log::info('20歳以下はいません');
        }

        //<----------05 step5 ------------------>
        $memberCount = $allMember->count(); 
        // Log::info(json_encode($memberCount, JSON_UNESCAPED_UNICODE));
        
        //<----------05 step6 ------------------>
        $tokyoMembers = $allMember->map(function($item) { 
            if ($item['area'] == '東京') {
                return $item;
            }
        });
        // Log::info(json_encode($tokyoMembers, JSON_UNESCAPED_UNICODE));
        
        //<----------05 step7 ------------------>
        $areaData = $allMember->pluck('area'); 

        // Log::info(json_encode($areaData, JSON_UNESCAPED_UNICODE));

        //<----------05 step8 ------------------>
        $sortMembers = $allMember->sortByDesc('age');

        // Log::info(json_encode($sortMembers, JSON_UNESCAPED_UNICODE));

        //<------  07 step3 ---------->

        $isEmptyArea = $member->findAreaMembers($area)->isEmpty();

        if (isset($area)){
            $getAreaMembers = $member->findAreaMembers($area);
            Log::info(json_encode($getAreaMembers, JSON_UNESCAPED_UNICODE));
        }

        if (!isset($area)){
            $getAreaMembers = $member->all();
            Log::info(json_encode($getAreaMembers, JSON_UNESCAPED_UNICODE));
        }

        if ($isEmptyArea && isset($area)) {
            Log::info('該当するユーザーはいません');
        }


        return 'test';
    }

    public function show(Member $member, $id)
    {
        //<------  07 step1 ---------->
        $findIdUser = $member->findIdUser($id); 
        Log::info(json_encode($findIdUser, JSON_UNESCAPED_UNICODE));
        return 'test';
    }

    public function searchMembers(Request $request, Member $member) {
        $minAgeData = $request->input('minAge'); 
        $maxAgeData = $request->input('maxAge'); //07 step4

        //<------  07 step5 ---------->
        $selectUser = $member->minAgeUser($minAgeData);
        // Log::info(json_encode($selectUser, JSON_UNESCAPED_UNICODE));


        //<-------07 step6 ------>
        if(isset($minAgeData) && isset($maxAgeData)) {
            $selectedUserData = $member->selectAgeUser($minAgeData, $maxAgeData);
            return $selectedUserData;
        }

        if (isset($minAgeData) && !isset($maxAgeData)) {
            $selectedUserData = $member->notMaxAgeUser($minAgeData);
            return $selectedUserData;
        }

        if (!isset($minAgeData) && !isset($maxAgeData)) {
            $selectedUserData = $member->all();
            return $selectedUserData;
        }
        return 'test';
}
}
