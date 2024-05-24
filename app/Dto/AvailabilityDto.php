<?php

namespace App\Dto;

class AvailabilityDto
{
    public int $productId;

    public string $activityStartDatetime;

    public int $activityDurationInMinutes;

    public int $placesAvailable;

    public function __construct(int $productId, string $activityStartDatetime, int $activityDurationInMinutes, int $placesAvailable)
    {
        $this->productId = $productId;
        $this->activityStartDatetime = $activityStartDatetime;
        $this->activityDurationInMinutes = $activityDurationInMinutes;
        $this->placesAvailable = $placesAvailable;
    }
}
