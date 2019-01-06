<?php

namespace Modules\Video\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class UpdateMediaRequest extends BaseFormRequest
{
    protected $translationsAttributesKey = 'video::media.form';

    public function rules()
    {
        return [
            'category_id' => 'required|integer',
            'video_link'  => 'required',
            'status'      => 'required|integer',
            'sorting'     => 'required|integer'
        ];
    }

    public function translationRules()
    {
        return [
            'title' => 'required',
            'slug'  => 'required'
        ];
    }

    public function attributes()
    {
        return trans('video::media.form');
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [];
    }

    public function translationMessages()
    {
        return [];
    }
}
