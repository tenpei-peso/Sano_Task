<?php

namespace App\Http\Requests\Artisan;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ArtisanRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'account_id' => ['required', 'integer'],
            'content' => ['required', 'string', 'max:140'],
            'study_time' => ['required', 'integer', 'min:1'],
            'genre' => ['required', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'account_id.required' => 'ユーザーIDを入力してください。', //入力が無かった場合のエラー文
            'content.required' => '内容を入力してください。',
            'study_time.required' => '学習時間を入力してください',
            'genre.required' => 'ジャンルを入力してください',
            'account_id.integer' => 'ユーザーIDは整数で入力してください',
            'study_time.integer' => '学習時間は整数で入力してください',
            'content.max' => '本文は140文字以内で入力してください',
            'study_time.min' => '最小1が最大24の整数 学習時間は1以上、24以内の整数で入力してください',
            'genre.string' => '「PHP」「Ruby」「Python」「JavaScript」「その他の言語」の中から入力してください',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'status' => 400, //jsonの返事の中身のエラー番号
            'errors' => $validator->errors(),
        ],400);

        //例外を知らせる。
        //throw new 例外クラス名（例外message）
        throw new HttpResponseException($response);
    }
}
