<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrganizationRequest extends FormRequest
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
            'name' => 'required|max:255',
            'enName' => 'required|max:255',
            'organizerName' => 'required',
            'enOrganizerName' => 'required',
            'startDate' => 'required',
            'startTime' => 'required',
            'endDate' => 'required',
            'endTime' => 'required',
            'registerStartDate' => 'required',
            'registerEndDate' => 'required',
            'participationType' => 'required',
            'eventClassificationId' => 'required',
            'location' => 'required',
            'enLocation' => 'required',
            'mainImage' => 'required',
            'attachments' => 'required',
            'description' => 'required',
            'enDescription' => 'required',

        ];
    }

    public function messages()
    {

        return [
            'name.required' => trans('site.nameEventRequired'),
            'enName.required' => trans('site.nameEventRequired'),
            'organizerName.required' => trans('site.organizerNameRequired'),
            'enOrganizerName.required' => trans('site.organizerNameRequired'),
            'startDate.required' => trans('site.startDateRequired'),
            'startTime.required' => trans('site.startTimeRequired'),
            'endDate.required' => trans('site.endDateRequired'),
            'endTime.required' => trans('site.endTimeRequired'),
            'registerStartDate.required' => trans('site.registerStartDateRequired'),
            'registerEndDate.required' => trans('site.registerEndDateRequired'),
            'participationType.required' => trans('site.participationTypeRequired'),
            'eventClassificationId.required' => trans('site.eventClassificationIdRequired'),
            'location.required' => trans('site.locationRequired'),
            'enLocation.required' => trans('site.locationRequired'),
            'mainImage.required' => trans('site.mainImageeventRequired'),
            'attachments.required' => trans('site.attachmentseventRequired'),
            'description.required' => trans('site.descriptioneventRequired'),
            'enDescription.required' => trans('site.descriptioneventRequired'),

        ];
    }
}
