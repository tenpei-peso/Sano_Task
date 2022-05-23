<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
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
}
