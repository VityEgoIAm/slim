<?php

declare(strict_types=1);

namespace App\Domain\Service;

interface GeocoderInterface
{
    public function getInfromation(string $address): GeocoderDto;
}
