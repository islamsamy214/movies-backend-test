<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMovieRequest extends FormRequest
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
        $categories = Category::select('id')->get();
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['string', 'max:5000'],
            'image' => ['image', 'max:2000'],
            'categories_ids' => ['required', 'array', Rule::in(Arr::pluck($categories, 'id'))]
        ];//end of rules
    }
}
