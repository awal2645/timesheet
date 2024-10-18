<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SMTPRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'mail_host' => ['required'],
            'mail_port' => ['required', 'numeric'],
            'mail_username' => ['required'],
            'mail_password' => ['required'],
            'mail_encryption' => ['required'],
            'mail_from_name' => ['required'],
            'mail_from_address' => ['required', 'email'],
        ];
    }
}
