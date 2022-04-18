<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use Illuminate\Support\Facades\Log;


class TeamController extends Controller
{
    public function showTeams (Team $team, $id) {
        //<-------02 step1---------->
        try {
            $getTeams = $team->getTeams($id);
        // Log::info(json_encode($getTeams, JSON_UNESCAPED_UNICODE));

        return $getTeams;
            
        } catch (\Exception $e){
            Log::emergency($e->getMessage());
            return $e;
        }
    }

    //<-------02 step3---------->
    public function selectedShowTeams(Team $team, $genre )
    {
        try {
            $genreTeams = $team->getGenreTeams($genre);
            // Log::info(json_encode($genreTeams, JSON_UNESCAPED_UNICODE));
            return 'test';
            
        } catch (\Exception $e){
            Log::emergency('post内容: . $genre');
            Log::emergency($e->getMessage());
            return $e;
        }
    }

    //<-------02 step5---------->
    public function searchTeam(Team $team, Request $request)
    {
        $minFeeData = $request->input('minFee'); 
        $maxFeeData = $request->input('maxFee');
        $genreData = $request->input('genre');

        try {
            $searchFeeData = $team->searchTeamData($minFeeData, $maxFeeData, $genreData);
            Log::info(json_encode($searchFeeData, JSON_UNESCAPED_UNICODE));
            return $searchFeeData;
            
        } catch (\Exception $e){
            Log::emergency('request1: . $minFeeData');
            Log::emergency('request2: . $maxFeeData');
            Log::emergency('request3: . $genreData');
            Log::emergency($e->getMessage());
            return $e;
        }
    }
}
