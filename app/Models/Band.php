<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Band extends Model
{
    use HasFactory;

    protected $guarded = [];

    //リレーション
    public function staffs()
    {
        return $this->belongsToMany(Staff::class);
    }
    //リレーション

    public function bandWithStaff () {
        try {
            $bandData = $this->with('staffs')->get();
            return $bandData;

        } catch (\Exception $e){

            Log::emergency($e->getMessage());
            Log::emergency('取れてない');
            throw $e;
        }
    }

    //band新規作成
    public function bandCreate ($postData) {
        try {
            $bandData = $this->create($postData);
            return $bandData;

        } catch (\Exception $e){
            Log::emergency($e->getMessage());
            throw $e;
        }
    }

    public function addMiddleTable ($bandId, $staffId) {
        try {
            //*修正 バンドに参加するメンバーが一人の時と二人以上の時で分ける
            $staffCount = explode(',', $staffId);
            $bandData = $this->find($bandId);

            if(count($staffCount) == 1) {
                $bandSyncData = $bandData->staffs()->syncWithoutDetaching($staffId);
                return $bandSyncData;
            }

            if(count($staffCount) >= 2) {
                $bandSyncData = $bandData->staffs()->syncWithoutDetaching($staffCount);
                return $bandSyncData;
            }

        } catch (\Exception $e){
            Log::emergency($e->getMessage());
            throw $e;
        }
    }
}
