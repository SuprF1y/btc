<?php
/**
 * Author: willem.j.homan@gmail.com
 * Date: 13/09/17
 * Time: 12:59 PM
 */

namespace Integration\BigTinCan\Widget;


use BigTinCan\Widget\WidgetService;
use PHPUnit\Framework\TestCase;

/**
 * Integration tests specific to WidgetRestService implementation
 * Class WidgetRestServiceTest
 * @package Integration\BigTinCan\Widget
 */
class WidgetRestServiceTest extends TestCase
{
    /**
     * @expectedException \BigTinCan\Exception\ConfigurationException
     */
    public function testHostEnvVarRequired() {
        putenv('WIDGET_SERVER_HOST');
        global $container;
        $container->make(WidgetService::class);
    }
    /**
     * @expectedException \BigTinCan\Exception\ConfigurationException
     */
    public function testSchemeEnvVarRequired() {
        putenv('WIDGET_SERVER_SCHEME');
        global $container;
        $container->make(WidgetService::class);
    }
    /**
     * @expectedException \BigTinCan\Exception\ConfigurationException
     */
    public function testPortEnvVarRequired() {
        putenv('WIDGET_SERVER_PORT');
        global $container;
        $container->make(WidgetService::class);
    }
}
