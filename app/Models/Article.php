<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Article extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function articleListData () {
        try {
            $article = $this->all();
            return $article;

        } catch (\Exception $e){
            Log::emergency($e->getMessage());
            Log::emergency('取れてない');
            throw $e;
        }
    }
}
