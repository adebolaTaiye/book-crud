<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use DateTime;

class StoreBookRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'author' =>'required|string',
            'description' => 'required|string',
            'published_year' => 'required|digits:4',
            'status' => ['required', Rule::in(['available','borrowed','reserved'])]
        ];
    }

    public function messages()
    {
        return [
            'published_year.max' => 'The year cannot exceed the current year',
            'published_year.min' => 'The year cannot exceed the current year',
        ];
    }
}
