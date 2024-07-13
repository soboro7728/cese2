<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
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
            'date' => 'required|after:today',
            'time' => 'not_in:選択して下さい',
            'number' => 'required|min:1',
        ];
    }
    public function messages()
    {
        return [
            'date.after' => '予約日は、今日より後の日付を指定してください。',
            'date.required' => '日付を入力してください',
            'number.required' => '利用人数を入力してください',
            'time.not_in' => '予約時間を選択してください',
        ];
    }
}
