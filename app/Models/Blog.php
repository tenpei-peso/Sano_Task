<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;

class Blog extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    //---------リレーションーーーーーー
    public function user () {
        return $this->belongsTo(User::class);
    }

    public function second_category () {
        return $this->belongsTo(SecondCategory::class);
    }

    public function tags () {
        return $this->belongsToMany(Tag::class);
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

    public function blogCreate ($postData, $user_id) {
        //postに渡すデータ onlyでとってきた値と現在ログイン中のIDをマージする。
        $mergeData = array_merge($postData, ['user_id' => $user_id]);
        Log::info($mergeData);
        try {
            $createData = $this->create($mergeData);
            return $createData;
        } catch(\Exception $e) {
            Log::info('Modelで取得できませんでした');
            Log::info($postData);
            Log::info($user_id);
            Log::emergency($e->getMessage());
            throw $e;
        }
    }

    public function tagCreate ($createData, $input_tag) {
        if (isset($input_tag)) {
            $tag_ids = [];
            $tags = explode('#', $input_tag);
            foreach ($tags as $tag) {
                $tag = Tag::updateOrCreate(
                    [
                        'tag' => $tag,
                    ]
                );
                $tag_ids[] = $tag->id;
            }
            $createData->tags()->sync($tag_ids);
        }
    }

    public function findWhoBlog ($blogId) {
        try {
            $userData = $this->find($blogId)->user;
            return $userData;

        } catch (\Exception $e) {
            Log::info('Modelで取得できませんでした');
            Log::info($userData);
            Log::emergency($e->getMessage());
            throw $e;
        }
    }

    public function blogUpdate ($postData, $postId) {
        try {
            $updatedBlogData = $this->where('id', $postId)->update($postData);
            Log::info('成功なら1失敗なら0 :'. $updatedBlogData);
            return $updatedBlogData;

        } catch (\Exception $e) {
            Log::info('Modelで取得できませんでした');
            Log::emergency($e->getMessage());
            throw $e;
        }
    }

    public function blogDelete ($userId) {
        try {
            $updatedBlogData = $this->find($userId)->delete();
            Log::info('削除成功 :'. $updatedBlogData);
            return $updatedBlogData;

        } catch (\Exception $e) {
            Log::info('Modelで取得できませんでした');
            Log::info($userId);
            Log::emergency($e->getMessage());
            throw $e;
        }
    }

    public function searchTagName ($keyword) {
        try {
            $query = Blog::query();
            $searchedData = Blog::whereHas('tags', function ($query) use ($keyword) {
                $query->where('tag', 'LIKE', "%{$keyword}%");
                })->get();

            Log::info('検索成功 :'. $searchedData);
            return $searchedData;

        } catch (\Exception $e) {
            Log::info('Modelで取得できませんでした');
            Log::info($keyword);
            Log::emergency($e->getMessage());
            throw $e;
        }
    }

    public function searchBlogCategory ($category) {
        try {
            $categoryData = Blog::whereHas('second_category', function ($query) use ($category) {
                $query->where('name', 'LIKE', "%{$category}%");
                })->get();
            
            Log::info('カテゴリー検索' . $categoryData);
            return $categoryData;
        } catch (\Exception $e) {
            Log::info('Modelで取得できませんでした');
            Log::info($category);
            Log::emergency($e->getMessage());
            throw $e;
        }
    }


}
