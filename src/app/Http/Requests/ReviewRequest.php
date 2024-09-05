<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
            'stars' => 'required',
            'comment'=> 'max :400',
            'upload_file' => 'mimes:jpeg,png',
            'extensions:jpeg',
        ];
    }
    public function messages()
    {
        return [
            'stars.required' => '星で評価をしてください',
            'comment.min' => '400文字以下で入力してください',
            'upload_file.mimes' => '画像はjpegもしくはpngでアップロードして下さい',
        ];
    }
}
