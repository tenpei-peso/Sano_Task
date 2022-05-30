<?php

namespace App\Http\Controllers;

use App\Models\Band;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BandController extends Controller
{
    public function bandWithStaff (Band $band) {
        try {
            $bandData = $band->bandWithStaff();
            return $bandData;
        } catch (\Exception $e){
            Log::emergency($e->getMessage());
            return $e;
        }

        return $bandData;
    }

    //band新規作成
    public function bandCreate (Band $band, Request $request) {
        $postData = $request->only(['name', 'genre', 'people_count', 'introduction']);
        //*修正 post時に追加するメンバーのID入力部分を追加
        $staffId = $request->input('staff_id');

        try {
            DB::beginTransaction();
            $createBand = $band->bandCreate($postData);
            Log::info('band作成完了');
            
            //band作成後中間テーブルに入れる
            $band->addMiddleTable($createBand->id, $staffId);
            Log::info('中間テーブルに挿入完了');

            Log::info('トランザクション成功');
            DB::commit();
            return 'band登録完了';
        } catch (\Exception $e){
            DB::rollBack();
            Log::emergency('トランザクション失敗');
            Log::emergency($e->getMessage());
            return $e;
        }
    }
}
