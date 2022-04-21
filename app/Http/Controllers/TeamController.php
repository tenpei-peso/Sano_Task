<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use Illuminate\Support\Facades\Log;


class TeamController extends Controller
{
    // public function showTeams (Team $team) {
    //     //<-------02 step1---------->
    //     try {
    //         $getTeams = $team->getAllTeams();
    //         // Log::info(json_encode($getTeams, JSON_UNESCAPED_UNICODE));
    //         return $getTeams;
            
    //     } catch (\Exception $e){
    //         Log::emergency($e->getMessage());
    //         return $e;
    //     }
    // }

    // //<-------02 step3---------->
    // public function selectedShowTeams(Team $team, $genre )
    // {
    //     try {
    //         $genreTeams = $team->getGenreTeams($genre);
    //         // Log::info(json_encode($genreTeams, JSON_UNESCAPED_UNICODE));
    //         return 'test';
            
    //     } catch (\Exception $e){
    //         Log::emergency('post内容: . $genre');
    //         Log::emergency($e->getMessage());
    //         return $e;
    //     }
    // }

    // //<-------02 step5---------->
    // public function searchTeam(Team $team, Request $request)
    // {
    //     $minFeeData = $request->input('minFee'); 
    //     $maxFeeData = $request->input('maxFee');
    //     $genreData = $request->input('genre');

    //     try {
    //         $searchFeeData = $team->searchTeamData($minFeeData, $maxFeeData, $genreData);
    //         Log::info(json_encode($searchFeeData, JSON_UNESCAPED_UNICODE));
    //         return $searchFeeData;
            
    //     } catch (\Exception $e){
    //         Log::emergency('request1: . $minFeeData');
    //         Log::emergency('request2: . $maxFeeData');
    //         Log::emergency('request3: . $genreData');
    //         Log::emergency($e->getMessage());
    //         return $e;
    //     }
    // }

    // //<--------リレーション02 step4--------->
    // public function getTeamMemberData(Team $team) {
    //     try{
    //         $getData = $team->getTeamsMembers();
    //         Log::emergency('デート取得成功' . $getData);
    //         return $getData;
    //     } catch(\Exception $e) {
    //         Log::emergency($e->getMessage());
    //         return $e;
    //     }
    // }
    //<--------リレーション02 step4--------->

    //<-------基礎課題３ 08 step4--------->
    public function createTeamData (Request $request, Team $team) {
        $postData = $request->only(['name', 'explain', 'genre', 'fee', 'rank',]);
        try {
            $createdData = $team->createTeamDataModel($postData);
            return $createdData;

        } catch (\Exception $e){
            Log::emergency($postData);
            Log::emergency($e->getMessage());
            return $e;
        }
    }

    //<-------基礎課題３ 08 step4--------->
    public function updateTeamData (Request $request, Team $team) {
        $postData = $request->only(['id', 'name', 'explain', 'genre', 'fee', 'rank']);
        $postId = $request->input('id');

        try {
            $updatedData = $team->updateTeamDataModel($postData, $postId);
            return $updatedData;

        } catch (\Exception $e){
            Log::emergency('失敗:' . $postData);
            Log::emergency($e->getMessage());
            return $e;
        }
    }

    //<-------基礎課題３ 08 step4--------->
    public function deleteTeamData (Request $request, Team $team) {
        $requestId = $request->input('id');

        try {
            $deleteData = $team->deleteTeamDataModel($requestId);
            Log::emergency($requestId);
            return '成功' . $deleteData;

        } catch (\Exception $e){
            Log::emergency($requestId);
            Log::emergency('失敗');
            Log::emergency($e->getMessage());
            return $e;
        }
    }
}
