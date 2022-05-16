<?php

namespace App\Http\Requests\Blog;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateBlogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => ['required', 'integer'], //入力必須、文字列、最大255
            'second_category_id' => ['required', 'integer'],
            'title' => ['required', 'string', 'max:20'],
            'price' => ['required', 'integer'],
            'content' => ['required', 'min:5'],
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'user_idを入力してください。', 
            'second_category_id.required' => 'second_category_idを入力してください。', 
            'title.required' => 'タイトルを入力してください。', 
            'title.string' => '正しく入力してください', 
            'title.max' => '20文字以内で入力して下さい', 
            'price.required' => '値段を入力してください。', 
            'price.required' => '正しく入力してください。', 
            'content.required' => '内容を入力してください。', 
            'content.min' => '5文字以上で入力してください。',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'status' => 400, //jsonの返事の中身のエラー番号
            'errors' => $validator->errors(),
        ],400); //実際に送られるresponse codeが400番　これが無いと、jsonでエラーメッセージは返ってくるけど送れらてくるのは200番のstatusOKとくる。

        //例外を知らせる。
        //throw new 例外クラス名（例外message）
        throw new HttpResponseException($response);
    }
}
