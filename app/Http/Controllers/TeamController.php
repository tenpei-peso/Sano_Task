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

        //relation <-------01 step2---------->
        $getAllData = $team->getAllTeamsWithRank();
        Log::info(json_encode($getAllData, JSON_UNESCAPED_UNICODE));
        return 'test';
    }

    //<-------02 step3---------->
    public function selectedShowTeams(Team $team, $genre )
    {
        $genreTeams = $team->getGenreTeams($genre);
        Log::info(json_encode($genreTeams, JSON_UNESCAPED_UNICODE));
        return 'test';
    }

    //<-------02 step4---------->
    public function searchTeams(Team $team)
    {
        $team->searchTeams();
        return 'test';
    }

    //<-------02 step5---------->
    public function searchFeeTeams(Team $team, Request $request)
    {
        $minAgeData = $request->input('minAge'); 
        $maxAgeData = $request->input('maxAge');
        $genreData = $request->input('genre');


        $searchFeeData = $team->searchFeeTeams($minAgeData, $maxAgeData, $genreData);
        return $searchFeeData;
    }

    //<-------relation 02 step1---------->
    public function getHasManyData(Team $team) {
        $data = $team->getHasManyMember();
        Log::info(json_encode($data, JSON_UNESCAPED_UNICODE));
        return 'test';
    }

    public function getRelationData (Team $team) {
        $data = $team->getTeamsMembers();
        // Log::info(json_encode($data, JSON_UNESCAPED_UNICODE));
        return $data;
    }
}
