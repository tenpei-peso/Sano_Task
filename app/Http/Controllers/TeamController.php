<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use Illuminate\Support\Facades\Log;


class TeamController extends Controller
{
    public function showTeams (Team $team) {
        //<-------02 step1---------->
        $getTeams = $team->getAllTeams();
        // Log::info(json_encode($getTeams, JSON_UNESCAPED_UNICODE));

        return 'test';
    }

    //<-------02 step3---------->
    public function selectedShowTeams(Team $team, $genre )
    {
        $genreTeams = $team->getGenreTeams($genre);
        Log::info(json_encode($genreTeams, JSON_UNESCAPED_UNICODE));
        return 'test';
    }

    //<-------02 step5---------->
    public function searchTeam(Team $team, Request $request)
    {
        $minFeeData = $request->input('minFee'); 
        $maxFeeData = $request->input('maxFee');
        $genreData = $request->input('genre');


        $searchFeeData = $team->searchTeamData($minFeeData, $maxFeeData, $genreData);
        Log::info(json_encode($searchFeeData, JSON_UNESCAPED_UNICODE));
        return $searchFeeData;
    }
}
