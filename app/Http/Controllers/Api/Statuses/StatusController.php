<?php

namespace App\Http\Controllers\Api\Statuses;

use App\Http\Controllers\Controller;
use App\Services\Statuses\StatusService;

class StatusController extends Controller
{
	public function __construct(
		protected StatusService $service
	) {}

	public function index()
	{
		$statuses = $this->service->index();
		return response()->json($statuses);
	}
}
