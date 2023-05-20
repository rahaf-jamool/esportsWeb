<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ArticleFileRequest
 * @package App\Http\Requests
 */
class RegistrationRequest extends FormRequest
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
            'itemid' => 'required|exists:products_view,id',
            'FirstName' => 'required|min:2',
            //'MidlleName' => 'required_if:user_id,>,0|min:2',
            //'LastName' => 'required_if:user_id,>,0|min:2',
            //'Gender' => 'required_if:user_id,>,0',
            'BirthDate' => 'date_format:"Y-m-d"|required',
            //'JobTitle' => 'required_if:user_id,>,0',
            //'Tel' => 'required_if:user_id,>,0|numeric',
            'Mobile' => 'required|numeric',
           // 'Country_id' => 'required_if:user_id,>,0|exists:nations,id',
           // 'City' => 'required_if:user_id,>,0',
            //'Address' => 'required_if:user_id,>,0',
            'email' => 'required|email|max:255',
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
