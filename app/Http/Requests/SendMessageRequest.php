<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class SendMessageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'content' => 'nullable',
            'images' => 'nullable',
            'server_id' =>
            [   'required',
                'string',
                'exists' => Rule::exists('joining_details','server_id')->where('user_id',$this->user()->id),
            ],
        ];
    }

    public function messages(){
        return [
           'server_id.required' => 'Phải nhập server id',
           'server_id.exists' => 'Bạn chưa tham gia vào server',
        ];
    }
}
