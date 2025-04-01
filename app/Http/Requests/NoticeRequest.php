<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoticeRequest extends FormRequest
{
  public function authorize()
  {
    // true : 권한 없어도 괜찮음
    // false : 권한 필요
    return true;
  }
  public function rules()
  {
    return [
      'title' => 'required|string|max:255',
      'content' => 'required',
      'originFiles' => 'nullable',
      'files' => 'nullable',
    ];
  }

  public function messages()
  {
    return [
      'title.required' => "제목은 필수 값 입니다.",
      'content.required' => "내용은 필수 값 입나다.",
    ];
  }
}
