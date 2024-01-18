<?php

declare(strict_types=1);

namespace App\Domain\Service;

class YandexGeocoder implements GeocoderInterface
{
    public function getInfromation(string $address): GeocoderDto
    {
        return new GeocoderDto('Москва', [1 => 'Метро 1', 2 => 'Метро 2']);
    }
}
