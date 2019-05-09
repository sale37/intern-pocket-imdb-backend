<?php


namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
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
            'comment' => 'required|max:500',
        ];
    }

    public function messages()
    {
        return [
            'comment.required' => 'Email is required!',
        ];
    }
}