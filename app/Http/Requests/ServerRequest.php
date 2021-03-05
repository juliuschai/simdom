<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'deskripsi' => 'required|string|max:254',
            'unit' => 'required|string|max:254',
            'tipeUnit' => 'required|string|exists:tipe_units,nama',
            'keperuntukan' => 'required|string|max:254',
            'tipeKeperuntukan' => 'required|string|exists:tipe_units,nama',
            'no_rack' => 'nullable|string|max:254',
        ];
    }
}
