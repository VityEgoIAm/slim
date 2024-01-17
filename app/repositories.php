<?php
declare(strict_types=1);

use App\Domain\Shop\ShopRepository;
use App\Infrastructure\Persistence\Shop\PDOShopRepository;
use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
    // Here we map our UserRepository interface to its in memory implementation
    $containerBuilder->addDefinitions([
        ShopRepository::class => \DI\autowire(PDOShopRepository::class),
    ]);
};
