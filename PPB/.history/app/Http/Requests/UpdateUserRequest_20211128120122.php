<?php

namespace App\Http\Requests;

use App\Models\User;
use Illu
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_edit');
    }

    public function rules()
    {
        return [
            'firstname'       => [
                'string',
                'required',
            ],
            'lastname'       => [
                'string',
                'required',
            ],
            'email'      => [
                'required',
                'unique:users,email,' . request()->route('user')->id,
            ],
            'password'   => [
                'nullable',
            ],
            'roles'      => [
                'required',
                'array',
            ],
            'roles.*.id' => [
                'integer',
                'exists:roles,id',
            ],
        ];
    }
}
