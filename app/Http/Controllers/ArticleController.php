<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ArticleController extends Controller
{
    public function articleListData (Article $article) {
        try {
            $articleData = $article->articleListData();
            Log::info($articleData);
            return $articleData;

        } catch (\Exception $e){
            Log::emergency($e->getMessage());
            return $e;
        }
    }

    //記事作成
    public function createArticleData (Article $article, Request $request) {
        $postData = $request->only(['user_id', 'content', 'study_time', 'genre']);

        try {
            $createdData = $article->createArticleData($postData);
            Log::info($createdData);
            return '新規作成されました';

        } catch (\Exception $e){
            Log::emergency('postした値 :' . $postData);
            Log::emergency($e->getMessage());
            return $e;
        }
    }

    //記事編集
    public function updateArticleData (Article $article, Request $request) {
        $postData = $request->only(['user_id', 'content', 'study_time', 'genre']);
        $articleId = $request->input('id');

        try {
            $updatedData = $article->updateArticleData($postData, $articleId);
            Log::info($updatedData);
            return '編集されました';

        } catch (\Exception $e){
            Log::emergency('postした値 :' . $postData);
            Log::emergency($e->getMessage());
            return $e;
        }
    }

    //記事削除
    public function deleteArticleData (Article $article, Request $request) {
        $articleId = $request->input('id');

        try {
            $deletedData = $article->deleteArticleData($articleId);
            Log::info($deletedData);
            return '削除されました';

        } catch (\Exception $e){
            Log::emergency('postした値 :' . $articleId);
            Log::emergency($e->getMessage());
            return $e;
        }
    }
}
