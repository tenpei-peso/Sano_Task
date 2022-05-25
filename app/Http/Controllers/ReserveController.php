<?php

namespace App\Http\Controllers;

use App\Models\Reserve;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReserveController extends Controller
{
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
}
