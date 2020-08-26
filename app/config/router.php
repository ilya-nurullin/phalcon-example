<?php

/** @var Phalcon\Di\FactoryDefault $di */
/** @var Phalcon\Mvc\Router $router */

$router = $di->getRouter();

// Define your routes here

$router->addGet('/auth', 'Auth::loginForm')->setName('loginForm');
$router->addGet('/auth/register', 'Auth::registerForm')->setName('registerForm');

$router->addPost('/auth/login', 'Auth::checkLogin')->setName('login');
$router->addPost('/auth/reg', 'Auth::register')->setName('register');
$router->addPost('/auth/logout', 'Auth::logOut')->setName('logout');

$router->addGet('/admin', 'Admin::index')->setName('admin');

$router->handle($_SERVER['REQUEST_URI']);
