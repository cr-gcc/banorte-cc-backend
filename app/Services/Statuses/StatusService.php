<?php

namespace App\Services\Statuses;

use App\Models\Status;

class StatusService
{
	public function index()
	{
		return Status::where('active', true)->get();
	}
}
