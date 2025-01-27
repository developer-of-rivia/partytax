<?php

namespace App\Http\Requests\Requests\Expense;

use Illuminate\Foundation\Http\FormRequest;

class ExpenseStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'count' => 'required',
            'expenseType' => 'required',
        ];
    }


    public function messages()
    {
        return [
            'name' => [
                'required' => 'Поле NAME обязательно',
            ]
        ];
    }
}
