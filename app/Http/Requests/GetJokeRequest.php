<?php

namespace App\Http\Requests;

use App\Http\Enums\Joke\JokeTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GetJokeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category' => ['present', 'array', 'nullable' ],
            'blacklist' => ['present', 'array', 'nullable'],
            'type' => ['present', 'string', 'nullable', Rule::in(JokeTypeEnum::toArrayValues())],
        ];
    }
}
