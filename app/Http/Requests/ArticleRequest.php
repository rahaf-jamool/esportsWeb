<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'title' => 'required|max:255',
            'authorName' => 'required',
            'description' => 'required',
            'enTitle' => 'required|max:255',
            'enAuthorName' => 'required',
            'enDescription' => 'required',
            'mainImage' => 'required',
            'attachments' => 'required',
        ];
    }

    public function messages()
    {

        return [
            'title.required' => trans('site.titlerequired'),
            'enTitle.required' => trans('site.titlerequired'),
            'authorName.required' =>trans('site.authorNamerequired'),
            'enAuthorName.required' =>trans('site.authorNamerequired'),
            'description.required' => trans('site.descriptionrequired'),
            'enDescription.required' => trans('site.descriptionrequired'),
            'mainImage.required' =>trans('site.mainImagerequired'),
            'attachments.required' =>trans('site.attachmentsrequired'),

        ];
    }
}
