<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StaffController extends Controller
{
    public function staffWithBand (Staff $staff) {
        try {
            $staffData = $staff->staffWithBand();
            return $staffData;
        } catch (\Exception $e){
            Log::emergency($e->getMessage());
            return $e;
        }

        return $staffData;
    }

    //staff新規作成
    public function staffCreate (Staff $staff, Request $request) {
        $postData = $request->only(['name', 'grade', 'gender', 'part']);

        try {
            DB::beginTransaction();
            $createStaff = $staff->staffCreate($postData);
            Log::info('staff作成完了');
            
            //staff作成後中間テーブルに入れる
            $staff->addMiddleTable($createStaff->id);
            Log::info('中間テーブルに挿入完了');

            Log::info('トランザクション成功');
            DB::commit();
            return 'staff登録完了';
        } catch (\Exception $e){
            DB::rollBack();
            Log::emergency('トランザクション失敗');
            Log::emergency($e->getMessage());
            return $e;
        }
    }

    //staffアップデート
    public function staffUpdate (Staff $staff, Request $request) {
        $postData = $request->only(['name', 'grade', 'gender', 'part']);
        $id = $request->input('id');
        $band_id = $request->input('band_id');

        try {
            $staffData = $staff->staffUpdate($id, $postData);
            Log::info('staff編集完了');
            return $staffData;
        } catch (\Exception $e){
            Log::emergency($e->getMessage());
            return $e;
        }
    }

    //staff削除
    public function staffDelete (Staff $staff, Request $request) {
        $id = $request->input('id');
        $band_id = $request->input('band_id');

        try {
            $staffData = $staff->staffDelete($id);
            Log::info('staff削除完了');
            return $staffData;
        } catch (\Exception $e){
            Log::emergency($e->getMessage());
            return $e;
        }
    }
}
