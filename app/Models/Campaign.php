<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['name', 'system_name', 'db_name', 'active'])]
class Campaign extends Model
{
	protected $casts = [
		'active' => 'boolean',
	];

	public function getActiveAttribute($value): bool
	{
		return (bool) $value;
	}
}
