<?php

namespace App\Jobs;

use App\Http\datas\CollectionPoint\Storedata;
use App\Models\CollectionPoint;
use App\Services\CollectionPointService;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class GetGeoInfoJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public CollectionPointService $service,
        public array $data,
        public string $id
    )
    {
        $this->service = $service;
        $this->data = $data;
        $this->id = $id;

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $point = $this->service->findCollectionPointById($this->id);

            $geodata = $this->service->getGeoInfo($this->data['cep'], $this->data['neighborhood'], $this->data['city'], $this->data['state'], $this->data['street']);

            if ($geodata) {
                $point->latitude = $geodata['latitude'];
                $point->longitude = $geodata['longitude'];
                $point->save();
            }
        } catch (Exception $e) {
            Log::channel('npr')->error($e->getMessage());
        }
    }
}
