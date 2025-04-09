<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePertanyaanrequest extends FormRequest
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
   * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
   */
 // App\Http\Requests\UpdatePertanyaanRequest.php
public function rules()
{
    return [
        'pertanyaan_code' => 'required|string|max:255',
        'pertanyaan' => 'required|string'
    ];
}
}