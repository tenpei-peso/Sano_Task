<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Blog extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    //---------リレーションーーーーーー
    public function user () {
        return $this->belongsTo(User::class);
    }

    public function second_category () {
        return $this->belongsTo(SecondCategory::class);
    }
    //---------リレーションーーーーーー

    public function getBlogListData ($id) {
        try {
            $query = $this->query();
            
            if($id != null) {
                $query->where('id', $id);
            }

            $data = $query->get();
            return $data;
        } catch(\Exception $e) {
            Log::info('Modelで取得できませんでした');
            Log::info($id);
            Log::emergency($e->getMessage());
            throw $e;
        }
    }

    public function getBlogUserData () {
        try {
            $data = $this->with('user')->get();
            return $data;
        } catch(\Exception $e) {
            Log::info('Modelで取得できませんでした');
            Log::emergency($e->getMessage());
            throw $e;
        }
    }

    public function getBlogCategoryData () {
        try {
            $data = $this->with('second_category')->get();
            return $data;
        } catch(\Exception $e) {
            Log::info('Modelで取得できませんでした');
            Log::emergency($e->getMessage());
            throw $e;
        }
    }
}
