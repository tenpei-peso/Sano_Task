<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use App\Models\Rank;


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
    public function getAllTeams(){
        $teams = $this->all();
        return $teams;
    }
    //<-------02 step3---------->
    public function getGenreTeams($genre){
        $genreTeams = $this->where('genre', $genre)->get();
        return $genreTeams;
    }
    //<-------02 step4---------->
    public function searchTeams(){
        return 'test';
    }

    //<-------02 step5---------->
    public function searchFeeTeams($minAgeData = null, $maxAgeData = null, $genreData){

        if(isset($minAgeData) && isset($maxAgeData)) {
            $feeUser = $this->whereBetween('fee', [$minAgeData, $maxAgeData])->get();
            return $feeUser;
        }

        if(isset($minAgeData) && !isset($maxAgeData)) {
            $feeUser = $this->where('fee', '>=', $minAgeData)->get();
            return $feeUser;
        }

        if(!isset($minAgeData) && isset($maxAgeData)) {
            $feeUser = $this->where('fee', '<=', $maxAgeData)->get();
            return $feeUser;
        }

        if (!isset($minAgeData) && !isset($maxAgeData)) {
            $feedUser = $this->all();
            return $feedUser;
        }

        if (isset($minAgeData) && isset($maxAgeData) && isset($genreData)) {
            $selectedUser = $this->where([['fee', '>=', $minAgeData], ['fee', '<=', $maxAgeData], ['genre', '=', $genreData]])->get();
            return $selectedUser;
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