<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isEmpty;

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
        if ($area == !null) {
            $members = $this->where('area', $area)->get();
        } else {
            $members = $this->all();
        }

        return $members;
    }

    //<------  07 step5 & 6 ---------->
    public function searchSelectMembers($minAgeData = null, $maxAgeData = null) {
        $query = $this->query();

        if($minAgeData != null) {
            $query->where('age', '>=', $minAgeData);
        }

        if($maxAgeData != null) {
            $query->where('age', '<=', $maxAgeData);
        }

        $members = $query->get();
        return $members;
    }
//<-----------リレーション------------>
    public function practices()
    {
        return $this->belongsToMany(Practice::class);
    }

}
