<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Reserve extends Model
{
    use HasFactory;

    protected $guarded = [];

    //リレーション
    public function band () {
        return $this->belongsTo(Band::class);
    }

    public function reserveSearch ($date, $studio) {
        try {
            $query = $this->query();

            if($date != null) {
                $query->whereDate('date', $date);
            }

            if($studio != null) {
                $query->where('studio', $studio);
            }

            $reserve = $query->orderBy('start_time', 'asc')->with('band')->get();
            return $reserve;

        } catch (\Exception $e){

            Log::emergency($e->getMessage());
            Log::emergency('取れてない');
            throw $e;
        }
    }
}
