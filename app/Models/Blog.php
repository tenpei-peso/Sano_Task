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
}
