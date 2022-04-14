<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;


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

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
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

    //<-------02 step5---------->
    public function searchTeamData($minFeeData, $maxFeeData, $genreData){

        //<----------直したところーーーーーーーーー>
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
        //<----------直したところーーーーーーーーー>

    //     if(isset($minFeeData) && isset($maxFeeData)) {
    //         $feeUser = $this->whereBetween('fee', [$minFeeData, $maxFeeData])->get();
    //         return $feeUser;
    //     }

    //     if(isset($minFeeData) && !isset($maxFeeData)) {
    //         $feeUser = $this->where('fee', '>=', $minFeeData)->get();
    //         return $feeUser;
    //     }

    //     if(!isset($minFeeData) && isset($maxFeeData)) {
    //         $feeUser = $this->where('fee', '<=', $maxFeeData)->get();
    //         return $feeUser;
    //     }

    //     if (!isset($minFeeData) && !isset($maxFeeData)) {
    //         $feedUser = $this->all();
    //         return $feedUser;
    //     }

    //     if (isset($minFeeData) && isset($maxFeeData) && isset($genreData)) {
    //         $selectedUser = $this->where([['fee', '>=', $minFeeData], ['fee', '<=', $maxFeeData], ['genre', '=', $genreData]])->get();
    //         return $selectedUser;
    //     }
    }
}