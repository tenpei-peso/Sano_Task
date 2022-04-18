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
        'age',
        'area',
        'leader',
        'comment',
        'gender'
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
    
    public function getIdUser(){
        $user = $this->where('id', 1)->get();
        return $user;
    }

    public function getAreaUser(){
        $user = $this->where('area', '東京')->get();
        return $user;
    }

    public function getAgeUser(){
        $user = $this->where('age', '<=', 30)->get();
        return $user;
    }

    public function allUser() {
        $user = $this->all();
        return $user;
    }

    //<------  07 step1 ---------->
    public function findIdUser($id) {
        $findUser = $this->find($id);
        return $findUser;
    }

    //<------  07 step3 ---------->
    public function findAreaMembers($area) {
        $members = $this->where('area', $area)->get();
        return $members;
    }

    //<------  07 step5 ---------->
    public function minAgeUser($minAgeData) {
        $members = $this->where('age', '>=', $minAgeData)->get();
        return $members;
    }

    //<------  07 step6 ---------->
    public function selectAgeUser($minAgeData, $maxAgeData ) {
        $members = $this->whereBetween('age', [$minAgeData, $maxAgeData])->get();
        return $members;
    }

    public function notMaxAgeUser($minAgeData) {
        $members = $this->where('age', '>=', $minAgeData)->get();
        return $members;
    }




}
