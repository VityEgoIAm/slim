<?php
declare(strict_types=1);

namespace App\Domain\Geocoder;

interface GeocoderRepository
{
    /**
     * @param string $request
     * @return Geocoder
     * @throws GeocoderNotFoundException
     */
    public function findGeocoderOfRequest(string $request): Geocoder;

    /**
     * @param Geocoder $geocoder
     */
    public function persist(Geocoder $geocoder): bool;
}
