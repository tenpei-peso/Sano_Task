<?php

namespace App\Http\Controllers;

use App\Http\Requests\Blog\CreateBlogRequest;
use App\Models\Blog;
use App\Notifications\SendSlack;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use function PHPUnit\Framework\isEmpty;

class BlogController extends Controller
{
    use Notifiable;

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['getBlogListData', 'getBlogUserData', 'getBlogCategoryData', 'searchTagName', 'searchBlogCategory']]);
    }

    public function getBlogListData (Blog $blog, $id = null) {
        try {
            $blogData = $blog->getBlogListData($id);
            return $blogData;
        } catch(\Exception $e) {
            Log::info('Controllerで取得できませんでした');
            Log::info($id);
            Log::emergency($e->getMessage());
            throw $e;
        }
    }

    public function getBlogUserData (Blog $blog) {
        try {
            $blogData = $blog->getBlogUserData();
            return $blogData;
        } catch(\Exception $e) {
            Log::info('Controllerで取得できませんでした');
            Log::emergency($e->getMessage());
            throw $e;
        }
    }

    public function getBlogCategoryData (Blog $blog) {
        try {
            $categoryData = $blog->getBlogCategoryData();
            return $categoryData;
        } catch(\Exception $e) {
            Log::info('Controllerで取得できませんでした');
            Log::emergency($e->getMessage());
            throw $e;
        }
    }

    public function blogCreate (Blog $blog, CreateBlogRequest $request) {
        $postData = $request->only(['second_category_id', 'title', 'price', 'content']);
        $input_tag = $request->input('tag');
        $title = $request->input('title');
        $user_id = Auth::id();

        try {
            DB::beginTransaction();
            //blogとtagを同時に作成
            $createData = $blog->blogCreate($postData, $user_id); //ブログ作成
            Log::info('ブログ作成できた'. $createData);

            $createTag = $blog->tagCreate($createData, $input_tag); //タグ作成
            Log::info('タグ作成できた'. $createTag);

            //slack通知
            $slack = $this->notify(new SendSlack($title));
            Log::info('slack通知できた');

            DB::commit();
            return '作成できました';

        } catch (\Exception $e) {
            DB::rollBack();
            Log::info('Controllerで取得できませんでした');
            Log::emergency("transactionが失敗しました");
            Log::emergency($e->getMessage());
            throw $e;
        }
        
    }

    public function blogUpdate (Blog $blog, CreateBlogRequest $request, $blogId) {
        //そのブログの持ち主でないと編集できない。
        $findWhoBlog = $blog->findWhoBlog($blogId);
        if(Auth::user()->isNot($findWhoBlog)) {
            Log::info('違うユーザが操作しようとしています。');
            return response()->json(['error' => 'ページが存在しません'], 404);
        }

        $postData = $request->only(['second_category_id', 'title', 'price', 'content']);
        $postId = $request->input('id');
        try {
            $updatedData = $blog->blogUpdate($postData, $postId);
            Log::info('成功なら1失敗なら0 :'. $updatedData);
            return '編集完了';
        } catch(\Exception $e) {
            Log::info('Controllerで取得できませんでした');
            Log::emergency($e->getMessage());
            throw $e;
        }
    }

    public function blogDelete (Blog $blog, Request $request, $blogId) {
        //そのブログの持ち主でないと編集できない。
        $findWhoBlog = $blog->findWhoBlog($blogId);
        if(Auth::user()->isNot($findWhoBlog)) {
            Log::info('違うユーザが操作しようとしています。');
            return response()->json(['error' => 'ページが存在しません'], 404);
        }

        $userId = $request->input('id');

        try {
            $deletedData = $blog->blogDelete($userId);
            Log::info('削除成功 :'. $deletedData);
            return '削除完了';
        } catch(\Exception $e) {
            Log::info('Controllerで取得できませんでした');
            Log::emergency($e->getMessage());
            throw $e;
        }
    }

    public function searchTagName (Blog $blog, Request $request) {
        $keyword = $request->input("keyword");

        try {
            $searchedData = $blog->searchTagName($keyword);

            if (isEmpty($searchedData)) {
                return 'blogがありません';
            }

            Log::info('検索成功 :'. $searchedData);
            return $searchedData;
        } catch(\Exception $e) {
            Log::info('Controllerで取得できませんでした');
            Log::emergency($e->getMessage());
            throw $e;
        }
    }

    public function searchBlogCategory (Blog $blog, $category) {
        try {
            $categoryData = $blog->searchBlogCategory($category);

            Log::info('検索成功 :'. $categoryData);
            return $categoryData;
        } catch(\Exception $e) {
            Log::info('Controllerで取得できませんでした');
            Log::emergency($e->getMessage());
            throw $e;
        }
    }

    public function routeNotificationForSlack($notification)
    {
        return config('app.slack_url');
    }

}
