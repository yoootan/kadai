<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationEventRequest extends FormRequest
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
            'name' => 'bail|required|min:1',
            'email' => 'required|min:1',
            'tel' => 'required|min:1',
            'menu_id' => 'required|min:1'
        ];
    }

    public function messages(){

        return[
            'name.required' =>'お名前が入力されていません。',
            'email.required' =>'メールアドレスが入力されていません。',
            'tel.required' =>'電話番号が入力されていません。',
            'menu_id.required' =>'メニューを選択してください。',
            
        ];
    }
}
