<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Reserve extends Model
{
    use HasFactory;

    protected $guarded = [];

    //リレーション
    public function band () {
        return $this->belongsTo(Band::class);
    }

    public function reserveSearch ($date, $studio) {
        try {
            $query = $this->query();

            if($date != null) {
                $query->whereDate('date', $date);
            }

            if($studio != null) {
                $query->where('studio', $studio);
            }

            $reserve = $query->orderBy('start_time', 'asc')->with('band')->get();
            return $reserve;

        } catch (\Exception $e){

            Log::emergency($e->getMessage());
            Log::emergency('取れてない');
            throw $e;
        }
    }

    //重複チェック
    public function doubleCheck ($studio, $date, $registerStartTime, $registerFinishTime) {
        try {
            $checkData = $this->where('studio', $studio)
                ->where('date', $date)->where('finish_time', '>', $registerStartTime)
                ->where('start_time', '<', $registerFinishTime)->get();
            return $checkData;

        } catch (\Exception $e){

            Log::emergency($e->getMessage());
            Log::emergency('取れてない');
            throw $e;
        }
    }

    //予約作成
    public function createReserve ($postData) {
        try {
            $reserveData = $this->create($postData);
            return $reserveData;

        } catch (\Exception $e){
            Log::emergency($e->getMessage());
            throw $e;
        }   
    }
}   