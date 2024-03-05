<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
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
            'title' => 'required|max:255|string',
            'image' => 'nullable|mimes:png,jpeg,jpg,webp',
            'location' => 'required|max:255|string',
            'capacity' => 'required|integer',
            'availableSeats' => 'required|integer',
            'price' => 'required|numeric',
            'acceptance' => 'required|in:auto,manual',
            'status' => 'required|in:pending,accepted,rejected',
            'description' => 'required|string',
            'date' => 'required|date',
        ];
    }
}
