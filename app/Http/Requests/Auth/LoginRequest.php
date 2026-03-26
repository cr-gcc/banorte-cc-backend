<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
			'email' => 'required_without:user|email|max:255',
			'user' => 'required_without:email|string|max:10',
			'password' => 'required|min:8|max:255',
		];
	}

	public function messages(): array
	{
		return [
			'email.required_without' => 'El correo electrónico es requerido.',
			'user.required_without' => 'El usuario es requerido.',
			'password.required' => 'La contraseña es requerida.',
			'email.email' => 'El correo electrónico debe ser válido.',
			'user.string' => 'El usuario debe ser el RFC sin homoclave.',
			'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
			'password.max' => 'La contraseña debe tener menos de 255 caracteres.',
		];
	}

	public function attributes(): array
	{
		return [
			'email' => 'correo electrónico',
			'user' => 'usuario',
			'password' => 'contraseña',
		];
	}
}
