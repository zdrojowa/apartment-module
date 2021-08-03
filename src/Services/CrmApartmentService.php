<?php

namespace Selene\Modules\ApartmentModule\Services;

use GuzzleHttp\Client;
use Selene\Modules\ApartmentModule\Models\Apartment;

class CrmApartmentService
{
    protected $client;
    protected $endpoint;

    public function __construct(string $endpoint) {
        $this->endpoint = $endpoint;
        $this->client   = new Client([
            'base_uri' => $endpoint . '/api/v2/'
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

    public function getApartments(int $building) {
        return $this->call('locals', ['building' => $building])->locals;
    }

    public function update(int $building, string $type) {
        $apartments = $this->getApartments($building);
        foreach ($apartments as $local) {
            $point = strpos($local->number, '.');
            $number = $point ? substr($local->number, $point + 1) : $local->number;
            $apartment = Apartment::query()->where('number', '=', $number)->first();
            if (!$apartment) {
                $apartment = new Apartment();
                $apartment->number = $number;
            }

            $apartment->local_type = $type;
            $apartment->building_id = $building;
            $apartment->floor = $local->floor;
            $apartment->rooms_count = $local->rooms;
            $apartment->area = $local->surface;
            $apartment->terrace_area = $local->terrace_surface;
            $apartment->pdf_uri = $local->pdf ? ($this->endpoint . $local->pdf) : null;
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
