<?php

namespace App\Http\Requests\User;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
	 * @return array<string, ValidationRule|array<mixed>|string>
	 */
	public function rules(): array
	{
		return [
			'password' => ['required', 'string', 'min:8'],
			'password_confirmation' => ['required', 'string', 'min:8', 'same:password'],
		];
	}

	public function messages(): array
	{
		return [
			'password.required' => 'La contraseña es requerida.',
			'password.string' => 'La contraseña debe ser una cadena de texto.',
			'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
			'password_confirmation.required' => 'La confirmación de la contraseña es requerida.',
			'password_confirmation.string' => 'La confirmación de la contraseña debe ser una cadena de texto.',
			'password_confirmation.min' => 'La confirmación de la contraseña debe tener al menos 8 caracteres.',
			'password_confirmation.same' => 'La confirmación de la contraseña no coincide con la contraseña.',
		];
	}

	public function attributes(): array
	{
		return [
			'password' => 'Contraseña',
			'password_confirmation' => 'Confirmación de contraseña',
		];
	}
}
