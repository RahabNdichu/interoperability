<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreRecordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('record_create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'student_id' => [
                'required',
                'exists:students,id',
                'integer'
            ],
            'doctor' => [
                'string',
                'required',
            ],
            'diagnose' => [
                'string',
                'required',
            ],
            'doc' => [
                'required',
            ],
            'weight' => [
                'required',
            ],
            'description' => [
                'string',
                'required',
            ],
        ];
    }
}
