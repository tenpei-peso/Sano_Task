<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;



class Team extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'explain',
        'genre',
        'fee',
        'rank',
    ];

    // <-------------リレーション--------->
    public function practice()
    {
        return $this->hasMany(Practice::class);
    }

    //<-------02 step1---------->
    //<---------laravel３課題 発展４----------->
    public function getTeams($id){
        $query = $this->query();

        try {
            if($id != null) {
                $query->where('id', $id);
            }
    
            $teams = $query->with('practice.members')->get();
            return $teams;

        } catch (\Exception $e){
            Log::emergency('idの内容: . $id');
            Log::emergency($e->getMessage());
            throw $e;
        }
    }
    //<-------02 step3---------->
    public function getGenreTeams($genre){
        try {
            $genreTeams = $this->where('genre', $genre)->get();
            return $genreTeams;

        } catch (\Exception $e){
            Log::emergency('props内容: . $genre');
            Log::emergency($e->getMessage());
            throw $e;
        }
    }

    //<-------02 step5---------->
    public function searchTeamData($minFeeData, $maxFeeData, $genreData){

        //<----------直したところーーーーーーーーー>
        try {
            $query = $this->query();
    
            if($minFeeData != null){
                $query->where('fee', '>=', $minFeeData);
            }
            
            if($maxFeeData != null){
                $query->where('fee', '<=', $maxFeeData);
            }
            
            if($genreData != null){
                $query->where('genre', $genreData);
            }
            
            $teams = $query->get();
            return $teams;
            
        } catch (\Exception $e){
            Log::emergency('props内容1: . $minFeeData');
            Log::emergency('props内容2: . $maxFeeData');
            Log::emergency('props内容3: . $genreData');
            Log::emergency($e->getMessage());
            throw $e;
        }
        
        if($maxFeeData != null){
            $query->where('fee', '<=', $maxFeeData);
        }
        
        if($genreData != null){
            $query->where('genre', $genreData);
        }
        
        $teams = $query->get();

        
        return $teams;
    }

}