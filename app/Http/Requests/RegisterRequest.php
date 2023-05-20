<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ArticleFileRequest
 * @package App\Http\Requests
 */
class RegisterRequest extends FormRequest
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
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'email' => 'required|email|max:255|unique:users,email,'.$this->id.',id,type,6',
            'password' => 'min:6|confirmed',
            'password_confirmation' => 'required_with:password|min:6',
            'mobile' => 'required|numeric',
            'city' => 'required',
            'country_id' => 'required|exists:nations,id',
            'sex' => 'required',
            'dob' => 'date_format:"Y-m-d"|required',
            'address' => 'required',
        ];
    }
//    public static function getMessages()
//    {
//        $messages = array();
//        $messages['title.required'] = trans('file.request_title_required');
//        $messages['title.min'] = trans('file.request_title_min');
//        $messages['image.required'] = trans('file.request_image_required');
//        $messages['image.image'] = trans('file.request_must_be_image');
//
//        return $messages;
//    }


    protected function formatErrors(Validator $validator)
    {
        return $validator->errors()->all();
    }
}
