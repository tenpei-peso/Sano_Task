<?php

namespace App\Http\Controllers;

use App\Models\Reserve;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Notifications\Notifiable;    //追記
use App\Notifications\SendSlack;    //追記
use Illuminate\Notifications\Messages\SlackMessage;    //追記

class ReserveController extends Controller
{
    use Notifiable;

    public function reserveSearch (Reserve $reserve, Request $request) {
        $date = $request->input('date');
        $studio = $request->input('studio');

        try {
            $reserveData = $reserve->reserveSearch($date, $studio);
            
            //予約がなければ予約ないと表示する
            if($reserveData->isEmpty()) {
                return '予約がありません';
            }
            Log::info('reserve検索完了');
            return $reserveData;
        } catch (\Exception $e){
            Log::emergency($e->getMessage());
            return $e;
        }
    }

    public function createReserve (Reserve $reserve, Request $request) {
        $studio = $request->input('studio');
        $date = $request->input('date');
        $registerStartTime = $request->input('start_time');
        $registerFinishTime = $request->input('finish_time');
        $postData = $request->only(['studio', 'band_id', 'date', 'start_time', 'finish_time',]);

        try {
            //重複チェック
            $doubleCheck = $reserve->doubleCheck($studio, $date, $registerStartTime, $registerFinishTime);
            Log::info('重複チェック完了' . $doubleCheck);

            //重複チェック確認で値があれば重複している
            if($doubleCheck->isNotEmpty()) {
                return '予約が重複しています';
            }

            //予約作成
            $createReserve = $reserve->createReserve($postData);
            //slack通知
            $slack = $this->notify(new SendSlack($studio, $date, $registerStartTime, $registerFinishTime));
            Log::info('予約作成完了');
            return $createReserve;

        } catch (\Exception $e){
            Log::emergency($e->getMessage());
            return $e;
        }
    }

    public function routeNotificationForSlack($notification)
    {
        return config('app.slack_url');
    }
}
