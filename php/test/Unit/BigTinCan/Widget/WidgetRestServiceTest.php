<?php
/**
 * Author: willem.j.homan@gmail.com
 * Date: 12/09/17
 * Time: 10:45 PM
 */

namespace Unit\BigTinCan\Widget;
use BigTinCan\Widget\Widget;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

use BigTinCan\Widget\WidgetRestService;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for WidgetRestService
 * Class WidgetRestServiceTest
 * @package Unit\BigTinCan\Widget
 */
class WidgetRestServiceTest extends TestCase
{
    const URL='http://dummy-url/widgets/';

    /**
     * @covers WidgetRestService::findAll()
     */
    public function testFindAll() {
        // Create a mock and queue a response.
        $mockHandler = new MockHandler([
            new Response(200, ['Content-Type:application/json'], '[{"id":"geo","name":"Geolocation"},{"id":"events","name":"events"}]')
        ]);

        $service = new WidgetRestService(self::URL, new Client(['handler' => $mockHandler]));
        $widgets = $service->findAll();

        $this->assertCount(2 , $widgets);
        $this->assertEquals(new Widget('geo', 'Geolocation'), array_shift($widgets) );
        $this->assertEquals(new Widget('events', 'events'), array_shift($widgets) );

    }

    /**
     * @covers WidgetRestService::findOneById()
     */
    public function testFindOneById() {
        // Create a mock and queue a response.
        $mockHandler = new MockHandler([
            new Response(200, ['Content-Type:application/json'], '{"id":"geo","name":"Geolocation"}')
        ]);

        $service = new WidgetRestService(self::URL, new Client(['handler' => $mockHandler]));
        $widget = $service->findById('geo');

        $this->assertEquals(new Widget('geo', 'Geolocation'), $widget);

    }

    /**
     * @expectedException \BigTinCan\Exception\ServiceException
     * @expectedExceptionMessage Could not decode response body or empty response body
     */
    public function testNoWidgets()
    {
        // Create a mock and queue a response.
        $mockHandler = new MockHandler([
            new Response(200, ['Content-Type:application/json'], '')
        ]);

        $service = new WidgetRestService(self::URL, new Client(['handler' => $mockHandler]));
        $service->findAll();

    }
    /**
     * @expectedException \BigTinCan\Exception\ServiceException
     * @expectedExceptionMessage Bad status code: 503
     */
    public function testServerError()
    {
        // Create a mock and queue a response.
        $mockHandler = new MockHandler([
            new Response(503, ['Content-Type:application/json'], '[]')
        ]);

        $service = new WidgetRestService(self::URL, new Client(['handler' => $mockHandler]));
        $service->findAll();

    }
    /**
     * @expectedException \BigTinCan\Exception\ServiceException
     * @expectedExceptionMessage Could not decode response body or empty response body
     */
    public function testEmptyResponseBody()
    {
        // Create a mock and queue a response.
        $mockHandler = new MockHandler([
            new Response(200, ['Content-Type:application/json'], '')
        ]);

        $service = new WidgetRestService(self::URL, new Client(['handler' => $mockHandler]));
        $service->findAll();

    }
}
