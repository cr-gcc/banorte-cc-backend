<?php

namespace App\Http\Controllers\Api\Campaigns;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Http\Requests\Campaigns\StoreRequest;
use App\Http\Requests\Campaigns\UpdateRequest;
use App\Services\Campaigns\CampaignService;

class CampaignController extends Controller
{
	public function __construct(
		protected CampaignService $service
	) {}

	public function index()
	{
		$campaigns = $this->service->index();
		return response()->json($campaigns);
	}

	public function store(StoreRequest $request)
	{
		$campaign = $this->service->store($request->validated());
		return response()->json($campaign);
	}

	public function update(UpdateRequest $request, Campaign $campaign)
	{
		$campaign = $this->service->update($campaign, $request->validated());
		return response()->json($campaign);
	}
}
