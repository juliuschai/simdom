<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermintaanRequest extends FormRequest
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
            'unit' => 'required|string|max:254',
            'tipeUnit' => 'required|string|exists:tipe_units,nama',
            'keperuntukan' => 'required|string|max:254',
            'tipeKeperuntukan' => 'required|string|exists:tipe_units,nama',
            'surat' => 'required|mimes:pdf,jpeg,jpg,png|max:2000',
            'deskripsi' => 'required|string|max:254',
            'domainDiajukan' => 'nullable|string|max:254',
            'serverDomain' => 'required|string|in:WHS,VPS,Colocation',
            'noRack' => 'required_if:serverDomain,Colocation|nullable|string',
            'kapasitas' => 'required|integer',
            'keterangan' => 'required|string|max:254',
        ];
    }
}
