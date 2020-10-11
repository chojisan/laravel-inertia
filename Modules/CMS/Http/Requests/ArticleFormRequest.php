<?php

namespace Modules\CMS\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleFormRequest extends FormRequest
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
            'title' => 'required',
            'featured' => 'nullable',
            'short_description' => 'nullable',
            'description' => 'nullable',
            'category_id' => 'required',
            'tags' => 'nullable',
            'image' => ['nullable', 'image'],
            'meta_description' => 'nullable',
            'meta_keywords' => 'nullable',
            'status' => 'required',
        ];
    }
}
