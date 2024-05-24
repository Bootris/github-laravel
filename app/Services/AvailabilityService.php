<?php

namespace App\Services;

use App\Dto\AvailabilityDto;
use Carbon\Carbon;

class AvailabilityService
{
    public static function filter(array $arguments, string $body): array
    {
        $data = json_decode($body);
        $filteredData = [];

        foreach ($data->availabilities as $availability) {
            $availabilityDto = new AvailabilityDto(
                productId: $availability->product_id,
                activityStartDatetime: $availability->activity_start_datetime,
                activityDurationInMinutes: $availability->activity_duration_in_minutes,
                placesAvailable: $availability->places_available
            );

            $startTime = Carbon::parse($availabilityDto->activityStartDatetime);
            $endTime = (clone $startTime)->addMinutes($availabilityDto->activityDurationInMinutes);

            if (
                $startTime->between($arguments['startTime'], $arguments['endTime']) &&
                $endTime->between($arguments['startTime'], $arguments['endTime']) &&
                $availabilityDto->placesAvailable > $arguments['numOfTravelers']
            ) {
                $productId = $availabilityDto->productId;
                $startDatetime = $availabilityDto->activityStartDatetime;

                if (! isset($filteredData[$productId])) {
                    $filteredData[$productId] = [
                        'product_id' => $productId,
                        'available_starttimes' => [],
                    ];
                }

                $filteredData[$productId]['available_starttimes'][] = $startDatetime;
            }
        }

        foreach ($filteredData as &$product) {
            sort($product['available_starttimes']);
        }
        dd($filteredData);
        return $filteredData;
    }
}
