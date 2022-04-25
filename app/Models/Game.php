<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'genre',
        'date',
        'start_time',
        'finish_time'
    ];

    public function getGameData() {
        try {
            $gameData = $this->all();
            return $gameData;

        } catch (\Exception $e){

            Log::emergency($e->getMessage());
            Log::emergency('取れてない');
            throw $e;
        }
    }

    public function getSearchGameData($genreData, $gameNameData, $dateData) {
        $query = $this->query();
            try {
                if ($genreData != null) {
                    $query->where('genre', $genreData);
                }
    
                if ($gameNameData != null) {
                    $query->where('name', $gameNameData);
                }
    
                if ($dateData != null) {
                    $query->where('date', $dateData);
                }
    
                $gameData = $query->get();
                return $gameData;
    
            } catch (\Exception $e){
                Log::emergency('.$genreData');
                Log::emergency('.$gameNameData');
                Log::emergency('.$dateData');
                Log::emergency($e->getMessage());
                return $e;
            }
    }


}
