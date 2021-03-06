<?php
/**
 * Author: willem.j.homan@gmail.com
 * Date: 13/09/17
 * Time: 10:56 AM
 */

// working real 1
// working real 2
// canonical 1
// canonical 2

// bb 1


// bb-2
// load variables from .env into environment

// bb 1.1
$env = new Dotenv\Dotenv(__DIR__);
$env->load();

// initialise the DI Container
$containerBuilder = new DI\ContainerBuilder();
$containerBuilder->addDefinitions(__DIR__ . '/src/BigTinCan/Widget/services.php');
$container = $containerBuilder->build();

// working 1