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

    protected $guarded = [
        'id',
    ];

    public $timestamps = false;
    
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

//<-----------リレーション------------>
    public function teams()
    {
        return $this->belongsToMany(Team::class, 'teams_members', 'member_id', 'team_id');
    }

    public function practices()
    {
        return $this->belongsToMany(Practice::class);
    }

    // <----------リレーション02 step2------------------>

    public function getTeamMember($id) {
        try{
            $teams = $this->where('id', $id)->with('team')->get();
            return $teams;
        } catch(\Exception $e) {
            Log::emergency('props内容: . $id');
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
    //<-------基礎課題３ 08 step1--------->
    public function createMemberDataModel ($postData) {
        try {
            //member作成
            $createdDataModel = $this->create($postData);

            Log::info(json_encode('member作成に成功:'. $createdDataModel, JSON_UNESCAPED_UNICODE));

            return $createdDataModel;
            
        } catch (\Exception $e){
            Log::emergency('member作成に失敗:' . $postData);
            Log::emergency($e->getMessage());
            throw $e;
        }
    }
    //<-------基礎課題３ 09 step1--------->
    public function createTeamMemberDataModel ($memberDataId) {
        try {
            //teamsMembers作成
            $createdTeamMembersModel = DB::table('teams_members')->insert([
                'team_id' => $memberDataId-90,
                'member_id' => $memberDataId
            ]);

            Log::info(json_encode('teamMember作成に成功:'. $createdTeamMembersModel, JSON_UNESCAPED_UNICODE));

            return $createdTeamMembersModel;
            
        } catch (\Exception $e){
            Log::emergency('table_member作成に失敗:' . $memberDataId);
            Log::emergency($e->getMessage());
            throw $e;
        }
    }

     //<-------基礎課題３ 08 step2--------->
    public function updateMemberDataModel ($postData, $postId) {
        try {
            $updatedMemberDataModel = $this->where('id', $postId)->update($postData);

            Log::info('アップデートに成功:'. $updatedMemberDataModel);
            Log::info(json_encode($postData, JSON_UNESCAPED_UNICODE));
            Log::info(json_encode($postId, JSON_UNESCAPED_UNICODE));

            return $updatedMemberDataModel;
            
        } catch (\Exception $e){
            Log::emergency('アップデートに失敗:' . $postData);
            Log::emergency($e->getMessage());
            throw $e;
        }
    }

     //<-------基礎課題３ 08 step3--------->
    public function deleteMemberDataModel ($id) {
        try {
            $deleteMemberDataModel = $this->where('id', $id)->delete();

            Log::info('削除に成功:'. $deleteMemberDataModel);
            Log::info(json_encode($id, JSON_UNESCAPED_UNICODE));
            return $deleteMemberDataModel;
            
        } catch (\Exception $e){
            Log::emergency('削除に失敗:');
            Log::emergency($e->getMessage());
            throw $e;
        }
    }
}
