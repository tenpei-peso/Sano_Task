<?php

namespace App\Http\Controllers;

use App\Models\Band;
use Illuminate\Http\Request;
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
}
