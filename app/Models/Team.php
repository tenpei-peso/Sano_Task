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
}