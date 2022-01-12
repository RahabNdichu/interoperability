<?php

namespace App\Http\Requests;

use App\LoanApplication;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class UpdateKpaApplicationRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('kp_application_edit') || !in_array($this->route()->kp_application->status_id, [6, 7]),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        return true;
    }

    public function rules()
    {
        return [
            'kpa_amount' => [
                'required',
            ],
        ];
    }
}
