<?php

namespace App\Http\Requests\Customer\Auth;

use App\DBRepository\Concretes\Customer\CustomerDto;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return is_null(auth()->user());
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'name' => ['required', 'string', 'min:3', 'max:256'],
            'password' => ['required', 'string', 'confirmed', 'min:6'],
        ];
    }

    public function getDto():CustomerDto
    {
        $dto = resolve(CustomerDto::class);

        $dto->email = $this->email;
        $dto->name = $this->name;
        $dto->password = $this->password;

        return $dto;
    }
}
