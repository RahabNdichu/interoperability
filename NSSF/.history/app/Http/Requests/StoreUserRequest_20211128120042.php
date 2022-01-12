<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_create');
    }

    public function rules()
    {
        return [
            'firstname'       => [
                'string',
                'required',
            ],
            'firstname'       => [
                'string',
                'required',
            ],
            'email'      => [
                'required',
                'unique:users',
            ],
            'id_no'      => [
                'required',
                'unique:users',
            ],
            'member_no'  => [
                'required',
                'unique:users',
            ],
            'password'   => [
                'required',
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
