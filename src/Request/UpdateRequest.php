<?php

namespace Pauljbergmann\LaravelInstaller\Request;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Pauljbergmann\LaravelInstaller\Helpers\Reply;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'hostname' => 'required',
            'username' => 'required',
            'database' => 'required',
        ];
    }

    /**
     * Parse the given errors into an appropriate value.
     *
     * @param  Validator $validator
     * @return array
     */
    protected function formatErrors(Validator $validator): array
    {
        return Reply::formErrors($validator);
    }
}
