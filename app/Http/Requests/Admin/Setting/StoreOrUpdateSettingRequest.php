<?php

namespace App\Http\Requests\Admin\Setting;

use App\Models\Setting\Setting;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrUpdateSettingRequest extends FormRequest
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
        $setting = Setting::first();
        if ($setting) {
            // dd('hi');
            return [
                'title' => 'required|string|max:255|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
                'description' => 'required|string|max:1000|min:2|',
                'keywords' => 'required|string|max:1000|min:2|',
                'logo' => 'image|mimes:png,jpg,jpeg,gif',
                'icon' => 'image|mimes:png,jpg,jpeg,gif',
            ];
        } else {
            return [
                'title' => 'required|string|max:255|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
                'description' => 'required|string|max:1000|min:2|',
                'keywords' => 'required|string|max:1000|min:2|',
                'logo' => 'required|image|mimes:png,jpg,jpeg,gif',
                'icon' => 'required|image|mimes:png,jpg,jpeg,gif',
            ];
        }
        
    }
}
