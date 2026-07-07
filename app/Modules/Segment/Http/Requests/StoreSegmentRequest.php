<?php

namespace App\Modules\Segment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSegmentRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'description' => ['nullable', 'string'],
        ];
    }
}
