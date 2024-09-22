<?php

namespace App\Services;

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


}
