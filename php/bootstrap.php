<?php
/**
 * Author: willem.j.homan@gmail.com
 * Date: 13/09/17
 * Time: 10:56 AM
 */

// b1.1
// c2.2
// c3.3
// working 1

// load variables from .env into environment
$env = new Dotenv\Dotenv(__DIR__);
$env->load();

// initialise the DI Container
$containerBuilder = new DI\ContainerBuilder();
$containerBuilder->addDefinitions(__DIR__ . '/src/BigTinCan/Widget/services.php');
$container = $containerBuilder->build();


