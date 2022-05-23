<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;

use function PHPUnit\Framework\isEmpty;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    //リレーション
    public function account () {
        return $this->belongsTo(Account::class);
    }

    public function likes () {
        return $this->hasMany(Likes::class);
    }
    //リレーション

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

    //記事作成
    public function createArticleData ($postData) {
        try {
            $createData = $this->create($postData);
            return $createData;

        } catch (\Exception $e){
            Log::emergency('記事作成失敗 :' . $postData);
            Log::emergency($e->getMessage());
            Log::emergency('modelで失敗');
            throw $e;
        }
    }
    
    //記事編集
    public function updateArticleData ($postData, $articleId) {
        try {
            $updateData = $this->where('id', $articleId)->update($postData);
            return $updateData;

        } catch (\Exception $e){
            Log::emergency('記事作成失敗 :' . $postData);
            Log::emergency($e->getMessage());
            Log::emergency('modelで失敗');
            throw $e;
        }
    }

    //記事削除
    public function deleteArticleData ($articleId) {
        try {
            $deleteData = $this->find($articleId)->delete();
            return $deleteData;

        } catch (\Exception $e){
            Log::emergency('記事作成失敗 :' . $articleId);
            Log::emergency($e->getMessage());
            Log::emergency('modelで失敗');
            throw $e;
        }
    }

    public function articleGenre ($genre) {
        try {
            $article = $this->where('genre', $genre)->get();

            if($article->isEmpty()) {
                return response()->json([
                    'message' => '記事が存在しません',
                ], 404);
            }

            return $article;

        } catch (\Exception $e){
            Log::emergency($e->getMessage());
            Log::emergency('取れてない');
            throw $e;
        }
    }
}
