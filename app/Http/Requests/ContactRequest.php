<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'subject' => 'required|string|max:200',
            'body' => 'required|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
            'email.unique' => 'This email has already been taken.',
            'subject.required' => 'The subject field is required.',
            'body.required' => 'The body field is required.',
            'images.*.mimes' => 'Only JPEG, PNG, JPG and GIF files are allowed.',
            'images.*.max' => 'Each of the image size must not exceed 2MB.',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Full Name',
            'email' => 'Email Address',
            'subject' => 'Subject',
            'body' => 'Message',
            'images.*' => 'Attachment',
        ];
    }
}
