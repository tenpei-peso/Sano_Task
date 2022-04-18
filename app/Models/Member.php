<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;



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
        try {
            $user = $this->where('id', 1)->get();
            return $user;

        } catch (\Exception $e){
            Log::emergency($e->getMessage());
            throw $e;
        }
    }

    public function getAreaUser(){
        try {
            $user = $this->where('area', '東京')->get();
            return $user;

        } catch (\Exception $e){
            Log::emergency($e->getMessage());
            throw $e;
        }
    }

    public function getAgeUser(){
        try {
            $user = $this->where('age', '<=', 30)->get();
            return $user;

        } catch (\Exception $e){
            Log::emergency($e->getMessage());
            throw $e;
        }
    }

    public function allUser() {
        try {
            $user = $this->all();
            return $user;

        } catch (\Exception $e){
            Log::emergency($e->getMessage());
            throw $e;
        }
    }

    // <------  07 step1 ---------->
    public function findIdUse($id) {
        try {
            $findUser = $this->find($id);
            return $findUser;
        } catch (\Exception $e){
            Log::emergency($e->getMessage());
            throw $e;
        }
    }

    //<------  07 step3 ---------->
    public function findAreaMembers($area) {
        try {
            if ($area == !null) {
                $members = $this->where('area', $area)->get();
            } else {
                $members = $this->all();
            }
            return $members;
            
        } catch (\Exception $e){
            Log::emergency('props内容: . $area');
            Log::emergency($e->getMessage());
            throw $e;
        }
    }

    //<------  07 step5 & 6 ---------->
    public function searchSelectMembers($minAgeData = null, $maxAgeData = null) {
        try {
            $query = $this->query();

            if($minAgeData != null) {
                $query->where('age', '>=', $minAgeData);
            }

            if($maxAgeData != null) {
                $query->where('age', '<=', $maxAgeData);
            }

            $members = $query->get();
            return $members;

        } catch (\Exception $e){
            Log::emergency('props内容: . $minAgeData . $maxAgeData');
            Log::emergency($e->getMessage());
            throw $e;
        }
    }
//<-----------リレーション------------>
    public function practices()
    {
        return $this->belongsToMany(Practice::class);
    }

}
