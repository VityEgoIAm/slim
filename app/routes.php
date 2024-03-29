<?php
declare(strict_types=1);

use App\Application\Actions\Geocoder\GeocoderAction;
use App\Application\Actions\Shop\ListShopsAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', GeocoderAction::class);

    $app->group('/shops', function (Group $group) {
        $group->get('', ListShopsAction::class);
    });
};
