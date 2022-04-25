<?php

namespace App\Http\Controllers;

use App\Models\Practice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PracticeController extends Controller
{
    //<問題1>
    public function getPracticeData(Practice $practice, $time = null) {

        try {
            $getData = $practice->practiceData($time);
            return $getData;
        } catch(\Exception $e) {
            Log::emergency('props内容: . $time');
            Log::emergency($e->getMessage());
            return $e;
        }
    }


}
