<?php

namespace App\Http\Requests\User;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
			'name' => 'required|string|max:255',
			'last_name' => 'required|string|max:255',
			'email' => 'nullable|email|max:255|unique:users,email,' . $this->route('user'),
			'user' => 'required|string|max:255|unique:users,user,' . $this->route('user'),
			'birth_date' => 'required|date',
			'active' => 'required|boolean',
		];
	}

	public function messages(): array
	{
		return [
			'name.required' => 'El nombre es requerido.',
			'last_name.required' => 'El apellido es requerido.',
			'email.required_without' => 'El correo electrónico es requerido.',
			'user.required_without' => 'El usuario es requerido.',
			'birth_date.required' => 'La fecha de nacimiento es requerida.',
			'active.required' => 'El estado es requerido.',
		];
	}

	public function attributes(): array
	{
		return [
			'name' => 'nombre',
			'last_name' => 'apellido',
			'email' => 'correo electrónico',
			'user' => 'usuario',
			'birth_date' => 'fecha de nacimiento',
			'active' => 'estado',
		];
	}
}
