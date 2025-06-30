<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWeightLogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'weight' => [
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
            'calories' => 'required|numeric',
            'exercise_time' => 'required|date_format:H:i',
            'exercise_content' => 'nullable|string|max:120',
        ];
    }

    public function messages()
    {
        return[
            'weight.required' => '体重を入力してください',
            'weight.numeric' => '数字で入力してください',
            'weight.regex' => '小数点は1桁で入力してください',
            'weight.max_digits' => '4桁までの数字で入力してください',
            'calories.required' => '摂取カロリーを入力してください',
            'calories.numeric' => '数字で入力してください',
            'exercise_time.required' => '運動時間を入力してください',
            'exercise_content.max' => '120文字以内で入力してください',
        ];
    }
}
