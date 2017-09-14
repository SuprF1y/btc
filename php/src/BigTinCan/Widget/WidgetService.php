<?php
/**
 * Author: willem.j.homan@gmail.com
 * Date: 13/09/17
 * Time: 12:50 PM
 */

namespace BigTinCan\Widget;

/**
 * interface defining API for WidgetService implementations
 * Interface WidgetService
 * @package BigTinCan\Widget
 */
interface  WidgetService
{
    /**
     * Find all Widgets
     * @return array|Widget[]
     */
    public function findAll(): array;

    /**
     * Find a single widget by Id
     * @param string $id
     * @return Widget
     */
    public function findById(string $id): Widget;
}
