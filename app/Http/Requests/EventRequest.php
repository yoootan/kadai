<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
            'title' => 'required|min:1',
            'start' => 'date_format:Y-m-d H:i:s|before:end',
            'end' => 'date_format:Y-m-d H:i:s|after:start'
        ];
    }

    public function messages(){

        return[
            'title.required' =>'タイトルが入力されていません。',
           // 'title.min' =>'',
            'start.date_format' => '開始日時を入力してください。',
            'start.before' => '開始日時を終了日時の前に設定してください。',
            'end.date_format' => '終了日時を入力してください。',
            'end.after' => '終了日時を開始日時の後に設定してください。'
            
        ];
    }
}
