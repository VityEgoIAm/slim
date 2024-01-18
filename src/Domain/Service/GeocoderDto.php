<?php
declare(strict_types=1);

namespace App\Domain\Service;

class GeocoderDto {
    /**
     * @var string
     */
    public $area;

    /**
     * @var array
     */
    public $metro;

    public function __construct(string $area, array $metro)
    {
        $this->area = $area;
        $this->metro = $metro;
    }
}
