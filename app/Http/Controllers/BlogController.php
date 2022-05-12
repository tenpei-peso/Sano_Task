<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BlogController extends Controller
{
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
}
