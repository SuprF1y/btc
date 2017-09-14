<?php
/**
 * Author: willem.j.homan@gmail.com
 * Date: 13/09/17
 * Time: 12:10 PM
 */

namespace BigTinCan\Widget;

/**
 * Widget DTO
 * Class Widget
 * @package BigTinCan\Widget
 */
class Widget
{
    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $name;

    public function __construct(string $id, string $name){

        $this->id = $id;
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }


}
