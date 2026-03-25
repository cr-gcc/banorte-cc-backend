<?php

namespace App\Services\Campaigns;

use App\Models\Campaign;
use Illuminate\Database\Eloquent\Collection;

class CampaignService
{
	/**
	 * Create a new class instance.
	 */
	public function __construct()
	{
		//
	}

	public function index(): Collection
	{
		return Campaign::where('active', true)->get();
	}

	public function store(array $data): Campaign
	{
		return Campaign::create($data);
	}

	public function update(Campaign $campaign, array $data): Campaign
	{
		$campaign->update($data);
		return $campaign;
	}
}
