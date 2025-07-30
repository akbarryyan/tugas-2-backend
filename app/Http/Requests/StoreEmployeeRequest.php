<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
            'image' => 'nullable|string|url',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'division' => 'required|uuid|exists:divisions,id',
            'position' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama karyawan wajib diisi',
            'phone.required' => 'No telepon wajib diisi',
            'division.required' => 'Divisi wajib dipilih',
            'division.exists' => 'Divisi tidak valid',
            'position.required' => 'Posisi/jabatan wajib diisi',
            'image.url' => 'Image harus berupa URL yang valid',
        ];
    }

    public function validated($key = null, $default = null)
    {
        $validated = parent::validated($key, $default);
        $validated['division_id'] = $validated['division'];
        unset($validated['division']);
        return $validated;
    }
}
