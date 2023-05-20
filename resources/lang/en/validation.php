<?php
return [
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | such as the size rules. Feel free to tweak each of these messages.
    |
    */
    'accepted'             => 'The field should accept: attribute',
    'active_url'           => 'Field: attribute is not a valid link',
    'after'                => 'The field: attribute should be a date later to date: date.',
    'after_or_equal'       => 'The :attribute must be a date after or equal to :date.',
    'alpha'                => 'The field: attribute should contain only characters',
    'alpha_dash'           => 'The field: attribute should not contain letters, numbers, and periods.',
    'alpha_num'            => 'The attribute should contain only letters and numbers',
    'array'                => 'The field should be: attribute matrix',
    'before'               => 'The field: attribute should be a date before the date: date.',
    'before_or_equal'      => 'The :attribute must be a date before or equal to :date.',
    'between'              => [
        'numeric' => 'The value of: attribute must be limited to: min and: max.',
        'file'    => 'The file size must be: attribute is limited to: min and: max KB.',
        'string'  => 'The number of characters should be limited to: min and: max',
        'array'   => 'The attribute must contain a number of items that are limited to: min and: max',
    ],
    'boolean'              => 'The field value should be: attribute either true or false',
    'confirmed'            => 'The confirmation field does not match the field: attribute',
    'date'                 => 'Field: attribute is not a valid date',
    'date_format'          => 'The field does not match: attribute with shape: format.',
    'different'            => 'The two fields should be: attribute and: other are different',
    'digits'               => 'The field should contain: attribute on: digits / digits',
    'digits_between'       => 'The field should contain: attribute between: min and: max number / digits',
    'dimensions'           => 'The: attribute has invalid image dimensions.',
    'distinct'             => 'For the field: attribute a duplicate value.',
    'email'                => 'It should be: attribute a valid e-mail address structure',
    'exists'               => 'Field: attribute nullٍ',
    'file'                 => 'The attribute must be of a file type.',
    'filled'               => 'Field: attribute is mandatory',
    'image'                => 'The field should be: attribute imageً',
    'in'                   => 'Field: attribute null',
    'in_array'             => 'Field: attribute not found in: other.',
    'integer'              => 'The field should be: attribute an integer',
    'ip'                   => 'The field should be: attribute an IP address with a valid structure',
    'json'                 => 'The field should be: attribute JSON type.',
    'max'                  => [
        'numeric' => 'The field value should be: attribute equal to or smaller for: max.',
        'file'    => 'The file size should not exceed: attribute: max KB',
        'string'  => 'Text length should not exceed: attribute: max characters / characters',
        'array'   => 'Field: attribute should not contain more than: max items / element.',
    ],
    'mimes'                => 'The field should be a file of type:: values.',
    'mimetypes'            => 'The field should be a file of type:: values.',
    'min'                  => [
        'numeric' => 'The value of the field should be: attribute equal to or greater than: min.',
        'file'    => 'The file size should be: attribute at least: min KB',
        'string'  => 'The length of the text should be: attribute at least: min characters / characters',
        'array'   => 'The attribute field should contain at least: min element / items',
    ],
    'not_in'               => 'Field: attribute nullٍ',
    'numeric'              => 'The field: attribute should be a number',
    'present'              => 'The field should provide: attribute',
    'regex'                => 'Field format: attribute. Incorrect',
    'required'             => ':field attribute is required.',
    'required_if'          => 'Field: attribute is required if: other equals: value.',
    'required_unless'      => 'Field: attribute is required if not: other equals: values.',
    'required_with'        => 'Field: attribute if available: values.',
    'required_with_all'    => 'Field: attribute if available: values.',
    'required_without'     => 'Field: attribute if not available: values.',
    'required_without_all' => 'Field: attribute if not available: values.',
    'same'                 => 'The field should match: attribute with: other',
    'size'                 => [
        'numeric' => 'The value of the field should be: attribute equal to: size',
        'file'    => 'The file size should be: attribute: size KB',
        'string'  => 'The text should contain: attribute on: size letters / characters exactly',
        'array'   => 'The field should contain: attribute on: size element / items exactly',
    ],
    'string'               => 'The field should be: attribute.',
    'timezone'             => 'The attribute should be: a valid time range',
    'unique'               => 'Field value: attribute used by',
    'uploaded'             => 'Failed to load attribute:',
    'url'                  => 'Link format: attribute is incorrect',
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */
    'custom'               => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */
    'attributes'           => [
        'name'                  => 'Name',
        'username'              => 'User Name',
        'email'                 => 'Email',
        'first_name'            => 'First Name',
        'last_name'             => 'Last Name',
        'password'              => 'Password',
        'password_confirmation' => 'Password Confirmation',
        'city'                  => 'City',
        'country'               => 'Country',
        'address'               => 'Address',
        'phone'                 => 'Phone',
        'mobile'                => 'Mobile',
        'age'                   => 'Age',
        'sex'                   => 'Sex',
        'gender'                => 'Gender',
        'day'                   => 'Day',
        'month'                 => 'Month',
        'year'                  => 'Year',
        'hour'                  => 'Hour',
        'minute'                => 'Minute',
        'second'                => 'Second',
        'title'                 => 'Title',
        'content'               => 'Content',
        'description'           => 'Description',
        'excerpt'               => 'Summary',
        'date'                  => 'Date',
        'time'                  => 'Time',
        'available'             => 'Available',
        'size'                  => 'Size',
        'message'                  => 'Message',
    ],
    'captcha' => 'Please insert a correct captcha code'
];
