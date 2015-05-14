<?php
/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */

// chdir(dirname(__DIR__)); // Not needed if index.php is in same directory as init_autoloader.php

// Decline static file requests back to the PHP built-in webserver
if (php_sapi_name() === 'cli-server' && is_file(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))) {
    return false;
}

// Setup autoloading
include 'init_autoloader.php';

// Start session manually to prevent error below caused by FlashMessenger
// "PHP Fatal error:  Class name must be a valid object or a string in Zend/Stdlib/ArrayObject.php on line 230"
// Solution from https://github.com/zendframework/zf2/issues/4386#issuecomment-24896063
$sessionManager = new Zend\Session\SessionManager();
$sessionManager->setName('unique-name-for-app');
$sessionManager->start();

// Run application
Zend\Mvc\Application::init(include 'config/application.config.php')->run();
