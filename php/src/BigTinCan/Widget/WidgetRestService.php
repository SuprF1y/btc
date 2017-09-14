<?php
/**
 * Author: willem.j.homan@gmail.com
 * Date: 12/09/17
 * Time: 9:41 PM
 */

namespace BigTinCan\Widget;

use BigTinCan\Exception\ServiceException;
use GuzzleHttp\ClientInterface;
use Psr\Http\Message\ResponseInterface;
use Teapot\StatusCode;

/**
 * REST Implementation of WidgetService
 * Class WidgetRestService
 * @package BigTinCan\Widget
 */
class WidgetRestService implements WidgetService
{
    /**
     * @var string
     */
    private $url;
    /**
     * @var ClientInterface
     */
    private $client;

    public function __construct(string $url, ClientInterface $client)
    {
        $this->url = $url;
        $this->client = $client;
    }

    /**
     * @inheritdoc
     */
    public function findAll(): array
    {
        $response = $this->client->request('GET', $this->url . "all", []);
        $widgets = $this->parseResponse($response);
        return array_map(
            function (array $widget) {
                return new Widget($widget['id'], $widget['name']);
            },
            $widgets
        );
    }

    /**
     * @inheritdoc
     */
    public function findById(string $id): Widget
    {
        $response = $this->client->request('GET', $this->url . "/$id", []);
        $widget = $this->parseResponse($response);
        return new Widget($widget['id'], $widget['name']);
    }


    /**
     * Decode the guzzle response, throwing exceptions if it is not what is expected
     * @param ResponseInterface $response
     * @return array
     */
    protected function parseResponse(ResponseInterface $response): array
    {
        // make sure we get a 200 response
        if ($response->getStatusCode() !== StatusCode::OK) {
            $this->reportError($response, "Bad status code: " . $response->getStatusCode());
        }

        // make sure we have a none empty valid body
        $widgetData = json_decode($response->getBody(), true);
        if ($widgetData === null) {
            $this->reportError($response, "Could not decode response body or empty response body");
        }

        return $widgetData;
    }

    protected function reportError(ResponseInterface $response, $reason)
    {
        throw ServiceException::fromResponse("Could not load Widgets: $reason", $response);
    }
}
