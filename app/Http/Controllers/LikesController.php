<?php

namespace App\Http\Controllers;

use App\Models\Likes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LikesController extends Controller
{
    public function like (Likes $likes, Request $request) {
        $postData = $request->only(['article_id', 'account_id']);
        try {
            $likeData = $likes->like($postData);
            Log::info('いいねしました');
            Log::info($likeData);
            return 'いいねしました';

        } catch (\Exception $e){
            Log::emergency($e->getMessage());
            return $e;
        }
        
    }
}
