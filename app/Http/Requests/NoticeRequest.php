<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoticeRequest extends FormRequest
{
  public function authorize()
  {
    return false;
  }
  public function rules()
  {
    return [
      'title' => 'required|string|max:255',
      'content' => 'required',
      'originFiles' => 'nullable|array',
      'files' => 'nullable|array',
    ];
  }
}
