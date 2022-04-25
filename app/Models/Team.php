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
    }
    // <----------リレーション------------------>

    public function rank() {
        return $this->hasOne(Rank::class, 'id', 'rank');
    }

    public function member() {
        return $this->hasMany(Member::class);
    }

    public function members()
    {
        return $this->belongsToMany(Member::class, 'teams_members', 'team_id', 'member_id');
    }
  
    public function practice()
    {
        return $this->hasMany(Practice::class);
    }
    // <----------リレーション------------------>

        //relation <-------01 step2---------->
    public function getAllTeamsWithRank(){
        $teams = $this->with('rank')->get();
        return $teams;
    }
        //relation <-------02 step1---------->
    public function getHasManyMember(){
        $teams = $this->where('id', 1)->with('member')->get();
        return $teams;
    }

    public function getTeamsMembers(){
        $teams = $this->where('id', 1)->with('members')->get();
        return $teams;
    }

}