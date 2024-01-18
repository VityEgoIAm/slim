<?php
declare(strict_types=1);

namespace App\Domain\Geocoder;

use App\Domain\Service\GeocoderDto;
use JsonSerializable;

class Geocoder implements JsonSerializable
{
    /**
     * @var int|null
     */
    private $id;

    /**
     * @var string
     */
    private $request;

    /**
     * @var string
     */
    private $response;

    /**
     * @param int|null  $id
     * @param string    $request
     * @param string    $response
     */
    public function __construct(?int $id, string $request, ?string $response)
    {
        $this->id = $id;
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * @return string    $request
     */
    public function getRequest() {
        return $this->request;
    }

    /**
     * @return string    $response
     */
    public function getResponse() {
        return $this->response;
    }

    /**
     * @return array    $metro
     */
    public function getMetro() {
        $response = json_decode($this->response);
        return array_slice((array)$response->metro, 0, 5);
    }

    /**
     * @param GeocoderDto    $response
     */
    public function setResponse(GeocoderDto $response) {
        $this->response = json_encode($response);
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'request' => $this->request,
            'response' => $this->response,
        ];
    }

    /**
     * @return bool
     */
    public function isNull()
    {
        if ($this->id == null) {
            return true;
        }
        return false;
    }
}
