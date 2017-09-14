<?php
/**
 * DI service definitions for the WidgetService
 * Author: willem.j.homan@gmail.com
 * Date: 13/09/17
 * Time: 11:05 AM
 */

use BigTinCan\Exception\ConfigurationException;
use BigTinCan\Widget\WidgetRestService;
use BigTinCan\Widget\WidgetService;
use DI\Scope;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;

return [
    // guzzle client
    ClientInterface::class =>
        DI\object(Client::class)
            ->scope(Scope::PROTOTYPE),

    // WidgetService
    WidgetService::class => function (ClientInterface $client) {
        $scheme = getEnvVar('WIDGET_SERVER_SCHEME');
        $host = getEnvVar('WIDGET_SERVER_HOST');
        $port = getEnvVar('WIDGET_SERVER_PORT');
        $url = $scheme . "://" . $host . ":" . $port . "/widgets/";

        return new WidgetRestService($url, $client);
    }
];

/**
 * loads an environment variable
 * @param $name
 * @return null|string
 * @throws ConfigurationException if env var is not set in the environment
 */
function getEnvVar($name): ?string
{
    $envVar = getenv($name);
    if ($envVar === false) {
        throw new ConfigurationException("Widget service has requires env var $name to be set");
    }
    return $envVar;
}
