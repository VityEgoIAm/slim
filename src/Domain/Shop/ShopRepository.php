<?php
declare(strict_types=1);

namespace App\Domain\Shop;

interface ShopRepository
{
    /**
     * @return Shop[]
     */
    public function findAllWithHighPrice(): array;
}
