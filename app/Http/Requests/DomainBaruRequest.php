<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DomainBaruRequest extends FormRequest
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
            'namaDomain' => 'required|string|max:254',
            'unit' => 'required|exists:units,id',
            'surat' => 'nullable|mimes:pdf,jpeg,jpg,png|max:2000',
            'tipeServer' => 'required|string', // PART:
            'kapasitas' => 'required|integer',
            'keterangan' => 'required|string|max:254',
        ];
    }
}
