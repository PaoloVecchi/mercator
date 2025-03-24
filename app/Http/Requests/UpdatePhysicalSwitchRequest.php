<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\Rule;

class UpdatePhysicalSwitchRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('physical_switch_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'min:2',
                'max:32',
                'required',
                Rule::unique('physical_switches')
                    ->ignore($this->route('physical_switch')->id ?? $this->id)
                    ->whereNull('deleted_at'),
            ],
        ];
    }
}
