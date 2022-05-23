<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class Account extends Model
{
    use HasFactory;

    protected $guarded = [];

    //リレーション
    public function articles () {
        return $this->hasMany(Article::class);
    }

    public function likes () {
        return $this->hasMany(Likes::class);
    }
    //リレーション

    public function accountListData () {
        try {
            $account = $this->all();
            return $account;

        } catch (\Exception $e){
            Log::emergency($e->getMessage());
            Log::emergency('取れてない');
            throw $e;
        }
    }

    public function searchAccount ($accountId) {
        try {
            $account = $this->where('id', $accountId)->get();
            Log::info('account_idから所得');
            return $account;

        } catch (\Exception $e){
            Log::emergency($e->getMessage());
            Log::emergency('取れてない');
            throw $e;
        }
    }

    public function createAccount ($id, $name, $email, $password) {
        try {
            $account = $this->create([
                'id' => $id,
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
            ]);
            return $account;

        } catch (\Exception $e){
            Log::emergency($e->getMessage());
            Log::emergency('取れてない');
            throw $e;
        }
    }


}
