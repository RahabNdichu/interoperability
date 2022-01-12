<?php

namespace App\Http\Requests;

use App\Models\KpaApplication;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class StoreLoanApplicationRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('kpa_application_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'loan_amount' => [
                'required',
                'gt:0',
            ],
        ];
    }
}
