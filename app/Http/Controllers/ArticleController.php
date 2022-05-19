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
}
