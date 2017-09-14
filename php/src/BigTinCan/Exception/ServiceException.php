<?php
/**
 * Author: willem.j.homan@gmail.com
 * Date: 13/09/17
 * Time: 12:08 PM
 */

namespace BigTinCan\Exception;


use Psr\Http\Message\ResponseInterface;

class ServiceException extends \Exception
{
    /**
     * factory method to create a ServiceException from a PSR7 ResponseInterface
     * @param string $message
     * @param ResponseInterface $response
     * @return ServiceException
     */
    public static function fromResponse(string $message, ResponseInterface $response){
        $message .= PHP_EOL . $response->getBody();
        return new ServiceException($message, $response->getStatusCode());
    }
}
