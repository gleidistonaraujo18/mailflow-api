<?php

namespace App\Modules\Segment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSegmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'name' => ['required', 'min:4', 'max:255'],
            'description' => ['required', 'string'],
        ];
    }


}
