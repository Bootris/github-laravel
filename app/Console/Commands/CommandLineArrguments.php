<?php

namespace App\Console\Commands;

use App\Services\AvailabilityService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class CommandLineArrguments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:command-line-arrguments {apiEndpoint} {startTime} {endTime} {numOfTravelers}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $apiEndpoint = $this->argument('apiEndpoint');
        $startTime = $this->argument('startTime');
        $endTime = $this->argument('endTime');
        $numOfTravelers = $this->argument('numOfTravelers');

        $startTime = Carbon::parse($startTime);
        $endTime = Carbon::parse($endTime);

        if (! $startTime->isBefore($endTime)) {
            return $this->error('Start Time is after End Time');
        }

        if ($numOfTravelers < 1 || $numOfTravelers > 30) {
            return $this->error('Number of travelers has to be between 1 and 30');
        }

        $arguments = [
            'apiEndpoint' => $apiEndpoint,
            'startTime' => $startTime,
            'endTime' => $endTime,
            'numOfTravelers' => $numOfTravelers,
        ];

        $response = Http::get($apiEndpoint);

        AvailabilityService::filter($arguments, $response->body());
    }
}
