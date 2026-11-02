<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCopanRequest extends FormRequest
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
            'code' => 'required|max:150|min:3|regex:/^[a-zA-Z0-9\-, ]+$/u',
            'amount' => 'required|numeric|gt:0',
            'amount_type' => 'required|in:0,1',
            'status' => 'required|in:0,1',
            'discount_ceiling' => 'nullable|required_if:amount_type,0|numeric|gt:0',
            'start_date' => 'required|numeric',
            'end_date' => 'required|numeric',
        ];
    }
}
