<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use Illuminate\Support\Facades\Log;



class GameController extends Controller
{
    public function getGameListData(Game $game) {
        try {
            $game->getGameData();
            return $game;
        } catch (\Exception $e){
            Log::emergency($e->getMessage());
            return $e;
        }

        return 'test';
    }

    public function searchGameData(Game $game, Request $request) {
        $genreData = $request->input('genre');
        $gameNameData = $request->input('name');
        $dateData = $request->input('date');
        try {
            $gameData = $game->getSearchGameData($genreData, $gameNameData, $dateData);
    
            return $gameData;

        } catch(\Exception $e) {
            Log::emergency($e->getMessage());
        }

        
    }
}
