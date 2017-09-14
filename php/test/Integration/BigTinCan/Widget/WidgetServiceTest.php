<?php
/**
 * Author: willem.j.homan@gmail.com
 * Date: 12/09/17
 * Time: 10:45 PM
 */

namespace Integration\BigTinCan\Widget;

use BigTinCan\Widget\WidgetService;
use PHPUnit\Framework\TestCase;

/**
 * Integration tests independent of WidgetService implementation
 * Class WidgetServiceTest
 * @package Integration\BigTinCan\Widget
 */
class WidgetServiceTest extends TestCase
{
    /**
     * data provider for WidgetService for tests
     * @return array
     */
    public function widgetServiceProvider(){
        global $container;
        return [[$container->make(WidgetService::class)]];
    }

    /**
     * Test for retrieving all widgets
     * @dataProvider widgetServiceProvider
     * @param WidgetService $widgetService
     * @throws \Exception
     */
    public function testFindAll(WidgetService $widgetService) {
        // retrieve all the widgets
        $widgets = $widgetService->findAll();

        // make sure we have some widgets
        if (empty($widgets)){
            throw new \Exception("No widgets found");
        }

        // for all of the widgets returned
        foreach($widgets as $widget ){
            // make sure that name and id contain non-empty values
            self::assertNotEmpty($widget->getId());
            self::assertNotEmpty($widget->getName());
        }
    }

    /**
     * Test for retrieving a single widget
     * @dataProvider widgetServiceProvider
     * @param WidgetService $widgetService
     * @throws \Exception
     */
    public function testFind(WidgetService $widgetService) {
        // retrieve all the widgets
        $widgets = $widgetService->findAll();

        // make sure we have some widgets
        if (empty($widgets)){
            throw new \Exception("No widgets found");
        }
        // for all of the widgets returned
        foreach($widgets as $i => $widget ){

            // only test the first 10
            if ( $i > 9 )break;

            // get the widget by id from the server
            $tempWidget = $widgetService->findById($widget->getId());

            // make sure the widget properties  aren't empty and the same as what we got from the /all endpoint
            self::assertNotEmpty($tempWidget->getId());
            $this->assertEquals($widget->getId(), $tempWidget->getId() );
            self::assertNotEmpty($tempWidget->getName());
            $this->assertEquals($widget->getName(), $tempWidget->getName() );
        }
    }
}
