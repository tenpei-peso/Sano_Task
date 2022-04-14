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
        'team_id',
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
        $user = DB::table('members')->where('id', 1)->get();
        return $user;
    }

    public function getAreaUser(){
        $user = DB::table('members')->where('area', '東京')->get();
        return $user;
    }

    public function getAgeUser(){
        $user = DB::table('members')->where('age', '<=', 30)->get();
        return $user;
    }

    public function allUser() {
        $user = DB::table('members')->get();
        return $user;
    }
    // <----------リレーション------------------>

    public function team() {
        return $this->belongsTo(Team::class);
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'member_team', 'team_id', 'member_id');
    }
    // <----------リレーション------------------>

    public function getTeamMember() {
        $teams = $this->where('id', 1)->with('team')->get();
        return $teams;
    }

}
