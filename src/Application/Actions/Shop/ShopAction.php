<?php
declare(strict_types=1);

namespace App\Application\Actions\Shop;

use App\Application\Actions\Action;
use App\Domain\Shop\ShopRepository;
use Psr\Log\LoggerInterface;

abstract class ShopAction extends Action
{
    /**
     * @var ShopRepository
     */
    protected $shopRepository;

    /**
     * @param LoggerInterface $logger
     * @param ShopRepository $shopRepository
     */
    public function __construct(LoggerInterface $logger,
                                ShopRepository $shopRepository
    ) {
        parent::__construct($logger);
        $this->shopRepository = $shopRepository;
    }
}
