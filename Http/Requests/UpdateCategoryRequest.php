<?php

namespace Modules\Video\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class UpdateCategoryRequest extends BaseFormRequest
{
    protected $translationsAttributesKey = 'video::categories.form';

    public function rules()
    {
        return [
            'status'      => 'required|integer'
        ];
    }

    public function translationRules()
    {
        $id = $this->route()->parameter('videoCategory')->id;

        return [
            'title'       => "required|unique:video__category_translations,slug,$id,category_id,locale,$this->localeKey",
            'slug'        => 'required'
        ];
    }

    public function attributes()
    {
        return trans('video::categories.form');
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
