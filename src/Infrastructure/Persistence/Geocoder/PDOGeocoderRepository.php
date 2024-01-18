<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Geocoder;

use App\Domain\Geocoder\Geocoder;
use App\Domain\Geocoder\GeocoderRepository;
use PDO;

class PDOGeocoderRepository implements GeocoderRepository
{
    private $pdo;

    /**
     * PDOGeocoderRepository constructor.
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * {@inheritdoc}
     */
    public function findGeocoderOfRequest(string $request): Geocoder
    {
        $statement = $this->pdo->prepare("SELECT * FROM geocoder WHERE request = '$request'");
        $statement->execute();
        $data = $statement->fetch(PDO::FETCH_ASSOC);

        if (empty($data)) {
            return $this->createNullGeocoder($request);
        }
        return $this->convertRecordToGeocoder($data);
    }

    /**
     * {@inheritdoc}
     */
    public function persist(Geocoder $geocoder): bool
    {
        $statement = $this->pdo->prepare("INSERT INTO geocoder (request, response) VALUES ('{$geocoder->getRequest()}', '{$geocoder->getResponse()}')");
        return $statement->execute();
    }

    /**
     * Convert a record to a geocoder.
     * 
     * @param array $record Record data.
     * @return Geocoder Geocoder.
     */
    private function convertRecordToGeocoder(array $record) {
        $geocoder = $this->createGeocoder(
                    $record['id'],
                    $record['request'],
                    $record['response'],
                );

        return $geocoder;
    }

    /**
     * Create geocoder.
     *
     * @param string $request request.
     * @return Geocoder Geocoder.
     */
    private function createNullGeocoder(string $request) {
        $geocoder = new Geocoder(null, $request, null);

        return $geocoder;
    }

    /**
     * Create geocoder.
     *
     * @param int $id Geocoder id.
     * @param string $request request.
     * @param string $response response.
     * @return Geocoder Geocoder.
     */
    private function createGeocoder(int $id, string $request, string $response) {
        $geocoder = new Geocoder($id, $request, $response);

        return $geocoder;
    }
}
