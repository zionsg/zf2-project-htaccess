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

// Init application
$application = Zend\Mvc\Application::init(include 'config/application.config.php');

// Start session manually to prevent error below caused by FlashMessenger, captcha and stuff stored in session:
//   "PHP Fatal error:  Class name must be a valid object or a string in Zend/Stdlib/ArrayObject.php on line 230"
// Solution from https://github.com/zendframework/zf2/issues/4386#issuecomment-24896063
// Code placed in between application init and run:
//   after init() else retrieving items from session will give "PHP Incomplete Class", eg. identity from auth service
//   before run() so that session will exist before application starts
$sessionManager = new Zend\Session\SessionManager();
$sessionManager->setName('app');
$sessionManager->start();

// Run application
$application->run();
