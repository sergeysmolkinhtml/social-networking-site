<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogPostCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title'        => 'required|min:5|max:200|unique:blog_posts',
            'slug'         => 'max:200',
            'content_raw'  => 'required|string|min:3|max:10000',
            /*'category_id'  => 'required|integer|exists:blog_categories,id',*/
        ];
    }
}
