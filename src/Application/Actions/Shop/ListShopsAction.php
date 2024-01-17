<?php
declare(strict_types=1);

namespace App\Application\Actions\Shop;

use Psr\Http\Message\ResponseInterface as Response;

class ListShopsAction extends ShopAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $shops = $this->shopRepository->findAllWithHighPrice();

        $this->logger->info("Shops list was viewed.");

        return $this->respondWithData($shops);
    }
}
