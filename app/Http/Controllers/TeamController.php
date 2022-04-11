<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use Illuminate\Support\Facades\Log;


class TeamController extends Controller
{
    public function showTeams (Team $team) {
        $getTeams = $team->getAllTeams();
        Log::info(json_encode($getTeams, JSON_UNESCAPED_UNICODE));

        return 'test';
    }

    public function selectedShowTeams(Team $team, $query )
    {
        $team->getGenreTeams($query);
    }

    public function searchTeams(Team $team)
    {
        $team->searchTeams();
    }

    public function searchChargeTeam(Team $team, Request $request)
    {
        $team->searchChargeTeams($request);
    }
}
