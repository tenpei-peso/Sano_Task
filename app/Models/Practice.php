<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Practice extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_id',
        'location',
        'date',
        'start_time',
        'finish_time',
    ];

// <-------------リレーション--------->
    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function members()
    {
        return $this->belongsToMany(Member::class);
    }

// <-------------リレーション--------->

//<問題1.2>
    public function practiceData($time) {
        $query = $this->query();
        $today=Carbon::today();

        if($time == 'past') {
            $query->whereDate('date', '<=', $today);
        }

        if($time == 'future') {
            $query->whereDate('date', '>', $today);
        }

        $practice = $query->with('team')->get();
        return $practice;
    }


}
