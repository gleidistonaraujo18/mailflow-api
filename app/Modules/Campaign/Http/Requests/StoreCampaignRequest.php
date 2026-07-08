<?php

namespace App\Modules\Campaign\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCampaignRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'segment_id' => ['required', 'exists:segments,id'],
            'subject' => ['required', 'string'],
            'body' => ['required', 'string'],
        ];
    }


}
