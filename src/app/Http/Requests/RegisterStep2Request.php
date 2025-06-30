<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterStep2Request extends FormRequest
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
            'target_weight' => [
                'required',
                'numeric',
                'regex:/^\d+(\.\d{1})?$/',
                function ($attribute, $value, $fail) {
                    $parts = explode('.', (string)$value);
                    if (strlen($parts[0]) > 3) {
                        $fail('4桁までの数字で入力してください');
                    }
                },
            ],
            'weight' => [
                'required',
                'numeric',
                'regex:/^\d+(\.\d{1})?$/',
                function ($attribute, $value, $fail) {
                    $parts = explode('.', (string)$value);
                    if (strlen($parts[0]) > 3) {
                        // ここで直接メッセージを渡す
                        $fail('4桁までの数字で入力してください');
                    }
                },
            ],
        ];
    }

    public function messages()
    {
        return[
            'target_weight.required' => '目標の体重を入力してください',
            'target_weight.numeric' => '数字で入力してください',
            'target_weight.regex' => '小数点は1桁で入力してください',
    
            'weight.required' => '現在の体重を入力してください',
            'weight.numeric' => '数字で入力してください',
            'weight.regex' => '小数点は1桁で入力してください',
        ];
    }
}
