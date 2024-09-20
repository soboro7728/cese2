<?php

namespace App\Services;

use Illuminate\Http\Resources\MissingValue;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;


class TestService
{
    public static function test()
    {
        return "staticメソッド in TestService";
    }

    public function test1()
    {
        return "インスタンスメソッド in TestService";
    }
    public function validateCsvDate(array $temps) : ViewErrorBag|null
{
    $rules = [
        'name' => [
            'required',
        ],
        // 'subject' => [
        //     'required',
        // ],
        // 'point' => [
        //     'nullable',
        //     'numeric',  //数値のみ
        // ],
    ];

// 　　// バリエーション対象項目名
    $attributes = [
        // 'id'      => 'ID',
        'name'    => 'name',
        // 'subject' => '教科',
        // 'point'   => '点数',
    ];

    // 各行に対してバリデーションチェックを行い、エラーの場合はメッセージを格納する 
    $upload_error_list = [];

    // すべての行に対してバリデーションチェックを行う
    foreach ($temps as $key => $value) {
        $validator = Validator::make($value, $rules, __('validation'), $attributes);

        // バリデーションエラーがあった場合
        if($validator->fails()) {
            $errorMessage = 'ミス';
            $upload_error_list = array_merge($upload_error_list, $errorMessage);
        }
    }

// 　　 // すべての行でバリデーションエラーがなかった場合
    if(empty($upload_error_list)) {
        return null;
    }
    // Requestのバリデーションエラーと同じ使い方をするため、エラーメッセージをViewErrorBagに入れる
    $errors = new ViewErrorBag();
    $messages = new MessageBag(['upload_errors' => $upload_error_list]);
    $errors->put('default', $messages);
    return $errors;
}
}