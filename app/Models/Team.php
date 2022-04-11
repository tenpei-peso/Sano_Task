<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;


class Member extends Model
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


    public function getAllTeams(){
        $teams = $this->all();
        return $teams;
    }

    public function getGenreTeams($query){
        $genre = $this->where('genre', $query)->get();
        return $genre;
    }

    public function searchTeams(){
        return 'test';
    }

    public function searchChargeTeam($request){
        $minAgeData = $request->input('minAge'); 
        $maxAgeData = $request->input('maxAge');
        $genreData = $request->input('genre');

        if($minAgeData == 100 && $maxAgeData == 1500) {
            $feeUser = $this->whereBetween('fee', [$minAgeData, $maxAgeData])->get();
            return $feeUser;
        }

        if($minAgeData == 100) {
            $feeUser = $this->where('fee', '>=', $minAgeData)->get();
            return $feeUser;
        }

        if($maxAgeData == 100) {
            $feeUser = $this->where('fee', '<=', $maxAgeData)->get();
            return $feeUser;
        }

        if (!isset($minAgeData) && !isset($maxAgeData)) {
            $feedUser = $this->all();
            return $feedUser;
        }

        if (isset($minAgeData) && isset($maxAgeData) && isset($genreData)) {
            $selectedUser = $this->where('fee', '>=', $minAgeData)->where('fee', '<=', $maxAgeData)->where('genre', $genreData)->get();
            return $selectedUser;
        }
    }
}