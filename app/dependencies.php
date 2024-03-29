<?php
declare(strict_types=1);

use App\Application\Settings\SettingsInterface;
use App\Domain\Service\GeocoderInterface;
use App\Domain\Service\YandexGeocoder;
use DI\ContainerBuilder;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        LoggerInterface::class => function (ContainerInterface $c) {
            $settings = $c->get(SettingsInterface::class);

            $loggerSettings = $settings->get('logger');
            $logger = new Logger($loggerSettings['name']);

            $processor = new UidProcessor();
            $logger->pushProcessor($processor);

            $handler = new StreamHandler($loggerSettings['path'], $loggerSettings['level']);
            $logger->pushHandler($handler);

            return $logger;
        },
        PDO::class => function (ContainerInterface $c) {

            $settings = $c->get(SettingsInterface::class);

            $dbSettings = $settings->get('db');

            $adapter = $dbSettings['adapter'];
            $host = $dbSettings['host'];
            $dbname = $dbSettings['dbname'];
            $username = $dbSettings['username'];
            $password = $dbSettings['password'];
            $dsn = "$adapter:host=$host;dbname=$dbname";
            return new PDO($dsn, $username, $password);
        },
        GeocoderInterface::class => function () {
            return new YandexGeocoder();
        },
    ]);
};
