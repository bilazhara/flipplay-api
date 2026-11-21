<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMediaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // POST: semua wajib. PATCH: hanya field yang dikirim yang divalidasi.
        $r = $this->isMethod('POST') ? 'required' : 'sometimes';

        return [
            'title'    => [$r, 'string', 'max:255', Rule::unique('media', 'title')->ignore($this->route('media'))],
            'type'     => [$r, Rule::in(['anime', 'manga'])],
            'year'     => [$r, 'integer', 'min:1900', 'max:2100'],
            'score'    => [$r, 'numeric', 'between:0,10'],
            'genres'   => [$r, 'array', 'min:1'],
            'genres.*' => ['string'],
            'episodes' => ['nullable', 'integer', 'min:1'],
            'chapters' => ['nullable', 'integer', 'min:1'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul media wajib diisi',
            'title.unique'   => 'Judul media sudah terdaftar',
            'type.required'  => 'Jenis media wajib diisi',
            'type.in'        => 'Jenis media harus anime atau manga',
            'year.required'  => 'Tahun wajib diisi',
            'score.required' => 'Skor wajib diisi',
            'score.between'  => 'Skor harus antara 0 sampai 10',
            'genres.required' => 'Genre wajib diisi minimal satu',
        ];
    }
}
