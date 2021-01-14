<?php

namespace Selene\Modules\ApartmentModule\Services;

use GuzzleHttp\Client;
use Selene\Modules\ApartmentModule\Models\Apartment;

class CrmApartmentService
{
    protected $client;
    protected $building;

    public function __construct(string $endpoint, string $building) {
        $this->building = $building;

        $this->client = new Client([
            'base_uri' => $endpoint
        ]);
    }

    protected function call(string $method, array $data = []) {
        $response = $this->client->get($method, [
            'query' => $data
        ]);

        $contents = $response->getBody()->getContents();

        if ($response->getStatusCode() !== 200) {
            throw new \Exception(
                'StatusCode: ' . $response->getStatusCode() . PHP_EOL . 'Response: ' . $contents
            );
        }
        return json_decode($contents, false, 512, JSON_THROW_ON_ERROR);
    }

    public function getApartments() {
        return $this->call('locals', ['building' => $this->building])->locals;
    }

    public function update() {
        $apartments = $this->getApartments();
        foreach ($apartments as $local) {
            $number = str_replace('G.', '', $local->number);
            $apartment = Apartment::query()->where('number', '=', $number)->first();
            if (!$apartment) {
                $apartment = new Apartment();
                $apartment->number = $number;
            }

            $apartment->floor = $local->floor;
            $apartment->rooms_count = $local->rooms;
            $apartment->area = $local->surface;
            $apartment->terrace_area = $local->terrace_surface;
            if ($local->is_reserved || $local->status === 2) {
                $apartment->status = 'reserved';
            } elseif ($local->status === 3) {
                $apartment->status = 'sold';
            } else {
                $apartment->status = 'available';
            }
            $apartment->save();
        }
    }
}
