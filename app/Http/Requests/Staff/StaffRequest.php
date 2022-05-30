<?php

namespace App\Http\Requests\Staff;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class StaffRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:15'], //入力必須、文字列、最大255
            'gender' => ['required', 'string'],
            'grade' => ['required', 'integer'],
            'part' => ['required', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '名前を入力してください。', //入力が無かった場合のエラー文
            'gender.required' => '性別を入力してください。',
            'grade.required' => '学年を入力してください。',
            'part.required' => 'パートを入力してください。',
            'name.string' => '名前を文字で入力してください。',
            'name.max' => '15文字以内で入力してください',
            'gender.string' => '性別を文字で入力してください。',
            'grade.integer' => '学年を整数で入力してください',
            'part.string' => 'パートを文字で入力してください。',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'status' => 400, 
            'errors' => $validator->errors(),
        ],400); 

        throw new HttpResponseException($response);
    }
}
