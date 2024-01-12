<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /*
     * Determine if the user is authorized to make this request.
     ! this check if the user is authorized to check the request or do the action or not:
     */
    public function authorize(): bool
    {
        // ? if we do the autorize in controller:
        // todo: return true;
        // ? if not:
        // ! first user is the logged in user and second one is the route binding model:
        return $this->user()->can('update', $this->user);
    }

    /*
     * Get the validation rules that apply to the request.
     ! here we put the validation rules:
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'bio' => 'nullable|max:255',
            'image' => 'image',
            'name' => 'required'
        ];
    }
}
