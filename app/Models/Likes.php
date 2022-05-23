<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Likes extends Model
{
    use HasFactory;

    protected $guarded = [];

    //リレーション
    public function account () {
        return $this->belongsTo(Account::class);
    }

    public function article () {
        return $this->belongsTo(Article::class);
    }
    //リレーション

    public function like ($postData) {
        try {
            $like = $this->create($postData);
            return $like;

        } catch (\Exception $e){
            Log::emergency($e->getMessage());
            Log::emergency('取れてない');
            throw $e;
        }
    }
}
