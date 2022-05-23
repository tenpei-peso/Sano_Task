<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AccountController extends Controller
{
    public function accountListData (Account $account) {
        try {
            $accountData = $account->accountListData();
            Log::info($accountData);
            return $accountData;

        } catch (\Exception $e){
            Log::emergency($e->getMessage());
            return $e;
        }
    }
}
