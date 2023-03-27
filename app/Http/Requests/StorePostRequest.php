<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'min:3', 'unique:posts,title,' . $this->post_id],
            'description' => ['required', 'min:10'],
            'post_creator' => ['required', 'exists:users,id'],
            'image' => ['mimes:jpg,jpeg,png,gif']
        ];
    }

    public function messages(): array
    {
        return [
            'title' => [
                'required' => 'Title is required',
                'min' => 'Title must be larger than 3 Characters',
                'unique' => 'Title is must be Unique'
            ],
            'description' => [
                'required' => 'Description is Required',
                'min' => 'Description must be larger than 10 Characters'
            ],
            'image'=>[
                'mimes'=>'Invalid image format. Allowed formats: jpg, jpeg, png, gif'
            ]
        ];
    }
}
