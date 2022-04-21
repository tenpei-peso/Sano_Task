<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\SoftDeletes;


class Team extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [
        'id',
    ];
    public $timestamps = false;


    //<-------02 step1---------->
    public function getAllTeams(){
        try {
            $teams = $this->all();
            return $teams;
        } catch (\Exception $e){
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

     //<-------基礎課題３ 08 step4--------->
    public function createTeamDataModel ($postData) {
        try {
            $createdDataModel = $this->create($postData);
            Log::info('データ作成に成功:'. $createdDataModel);
            return $createdDataModel;
            
        } catch (\Exception $e){
            Log::emergency('データ作成に失敗:' . $postData);
            Log::emergency($e->getMessage());
            throw $e;
        }
    }

     //<-------基礎課題３ 08 step4--------->
    public function updateTeamDataModel ($postData, $postId) {
        try {
            $updatedTeamDataModel = $this->where('id', $postId)->update($postData);

            Log::info('アップデートに成功:'. $updatedTeamDataModel);
            Log::info(json_encode($postData, JSON_UNESCAPED_UNICODE));
            Log::info(json_encode($postId, JSON_UNESCAPED_UNICODE));

            return $updatedTeamDataModel;
            
        } catch (\Exception $e){
            Log::emergency('アップデートに失敗:' . $postData);
            Log::emergency($e->getMessage());
            throw $e;
        }
    }

     //<-------基礎課題３ 08 step4--------->
    public function deleteTeamDataModel ($id) {
        try {
            $deleteTeamDataModel = $this->where('id', $id)->delete();

            Log::info('削除に成功:'. $deleteTeamDataModel);
            Log::info(json_encode($id, JSON_UNESCAPED_UNICODE));

            return $deleteTeamDataModel;
            
        } catch (\Exception $e){
            Log::emergency('削除に失敗:');
            Log::emergency($e->getMessage());
            throw $e;
        }
    }
}