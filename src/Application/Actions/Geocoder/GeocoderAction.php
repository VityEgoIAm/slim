<?php
declare(strict_types=1);

namespace App\Application\Actions\Geocoder;

use App\Application\Actions\Action;
use App\Domain\Geocoder\GeocoderRepository;
use App\Domain\Service\GeocoderInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class GeocoderAction extends Action
{
    /**
     * @var GeocoderRepository
     */
    protected $geocoderRepository;
    /**
     * @var GeocoderInterface
     */
    protected $geocoder;

    /**
     * @param LoggerInterface $logger
     * @param GeocoderRepository $geocoderRepository
     */
    public function __construct(LoggerInterface $logger,
                                GeocoderRepository $geocoderRepository,
                                GeocoderInterface $geocoder
    ) {
        parent::__construct($logger);
        $this->geocoderRepository = $geocoderRepository;
        $this->geocoder = $geocoder;
    }

    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $address = $this->request->getQueryParams()['address'] ?? null;
        if ($address) {
            $geocoder = $this->geocoderRepository->findGeocoderOfRequest($address);
            if ($geocoder->isNull()) {
                $response = $this->geocoder->getInfromation($address);
                $geocoder->setResponse($response);
                $this->geocoderRepository->persist($geocoder);
            }
            return $this->respondWithData($geocoder->getMetro());
        }
        $this->response->getBody()->write('<form method="GET"><input type="text" name="address"><button type="submit">Отправить</button></form>');
        return $this->response;
    }
}
