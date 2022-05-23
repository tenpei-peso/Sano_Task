<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;

class Staff extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    //リレーション
    public function bands()
    {
        return $this->belongsToMany(Band::class);
    }
    //リレーション

    public function staffWithBand () {
        try {
            $staffData = $this->with('bands')->get();
            return $staffData;

        } catch (\Exception $e){

            Log::emergency($e->getMessage());
            Log::emergency('取れてない');
            throw $e;
        }
    }

    //staff新規作成
    public function staffCreate ($postData) {
        try {
            $staffData = $this->create($postData);
            return $staffData;

        } catch (\Exception $e){
            Log::emergency($e->getMessage());
            throw $e;
        }
    }

    //staff編集作成
    public function staffUpdate ($id, $postData) {
        try {
            $staffData = $this->where('id', $id)->update($postData);
            return $staffData;

        } catch (\Exception $e){
            Log::emergency($e->getMessage());
            throw $e;
        }
    }

    //staff編集作成
    public function staffDelete ($id) {
        try {
            $staffData = $this->find($id)->delete();
            return $staffData;

        } catch (\Exception $e){
            Log::emergency($e->getMessage());
            throw $e;
        }
    }

    // 作成後中間テーブルに入れる
    public function addMiddleTable ($staffId) {
        try {
            $staffData = $this->find($staffId);
            //バンドの数取得
            $bandCount = Band::count();
            $staffSyncData = $staffData->bands()->sync(rand(1, $bandCount));
            return $staffSyncData;

        } catch (\Exception $e){
            Log::emergency($e->getMessage());
            throw $e;
        }
    }
}
