<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Band extends Model
{
    use HasFactory;

    protected $guarded = [];

    //リレーション
    public function staffs()
    {
        return $this->belongsToMany(Staff::class);
    }
    //リレーション

    public function bandWithStaff () {
        try {
            $bandData = $this->with('staffs')->get();
            return $bandData;

        } catch (\Exception $e){

            Log::emergency($e->getMessage());
            Log::emergency('取れてない');
            throw $e;
        }
    }
}
