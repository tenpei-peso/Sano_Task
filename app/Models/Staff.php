<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Staff extends Model
{
    use HasFactory;

    protected $guarded = [];

    //リレーション
    public function bands()
    {
        return $this->belongsToMany(Band::class);
    }
    //リレーション

    public function staffWithBand () {
        try {
            $staffData = $this->with('bands')->get();
            return $staffData;

        } catch (\Exception $e){

            Log::emergency($e->getMessage());
            Log::emergency('取れてない');
            throw $e;
        }
    }
}
