<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;

class EventCreateRequest extends FormRequest
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
            "title" => ["required", "string", "max:255"],
            "description" => ["required", "string"],
            "location" => ["required", "string"],
            "featured_image" => ["required", "image"],
            "start_event_at" => ["required", "date"],
            "end_event_at" => ["required", "date"],
            "min_age" => ["required", "integer"],
            "price" => ["required", "numeric"],
            "quota" => ["required","integer"],
            "category_id" => ["required", "integer", "exists:event_categories,id"],
        ];
    }
}
