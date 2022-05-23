<?php

namespace App\Http\Controllers;

use App\Http\Requests\Artisan\ArtisanRequest;
use App\Models\Account;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
    public function createArticleData (Article $article, Account $account ,ArtisanRequest $request) {
        $postData = $request->only(['account_id', 'content', 'study_time', 'genre']);
        $accountId = $request->input('account_id');
        $accountName = $request->input('name');
        $accountEmail = $request->input('email');
        $accountPassword = $request->input('password');

        try {
            DB::beginTransaction();
            //account_idからアカウントが存在しているか確認
            $accountData = $account->searchAccount($accountId);
            
            //アカウント登録をしていないアカウントが記事を登録しようとしたら、アカウントの登録
            if($accountData->isEmpty()) {
                $account->createAccount($accountId ,$accountName, $accountEmail, $accountPassword);
                Log::info('アカウントが作成されました');
            } else {
                Log::info('アカウントが存在しています');
            }

            //記事作成
            $createdData = $article->createArticleData($postData);
            DB::commit();
            Log::info('トランザクション成功');
            return '新規作成されました';

        } catch (\Exception $e){
            DB::rollBack();
            Log::emergency('トランザクション失敗');
            Log::emergency($e->getMessage());
            return $e;
        }
    }

    //記事編集
    public function updateArticleData (Article $article, ArtisanRequest $request) {
        $postData = $request->only(['account_id', 'content', 'study_time', 'genre']);
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

    //genre検索
    public function articleGenre (Article $article, $genre) {
        try {
            $articleData = $article->articleGenre($genre);
            return $articleData;

        } catch (\Exception $e){
            Log::emergency('URLパラメータ値 :' . $genre);
            Log::emergency($e->getMessage());
            return $e;
        }
    }
}
