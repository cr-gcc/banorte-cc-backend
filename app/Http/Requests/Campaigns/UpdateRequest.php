<?php

namespace App\Http\Requests\Campaigns;

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
			'system_name' => 'required|string|max:255',
			'db_name' => 'required|string|max:255',
			'active' => 'required|boolean',
		];
	}

	public function messages(): array
	{
		return [
			'name.required' => 'El nombre es requerido',
			'system_name.required' => 'El nombre del sistema es requerido',
			'db_name.required' => 'El nombre de la base de datos es requerido',
			'active.required' => 'El estado es requerido',
		];
	}

	public function attributes(): array
	{
		return [
			'name' => 'nombre',
			'system_name' => 'nombre del sistema',
			'db_name' => 'nombre de la base de datos',
			'active' => 'estado',
		];
	}
}
