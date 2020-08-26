<?php
/** @var Phalcon\Di\FactoryDefault $di */
$eventsManager = $di->get('eventsManager');

$eventsManager->attach(/*'router:matchedRoute'*/'dispatch:beforeExecuteRoute', function ($event, $containerspatcher) use ($di) {
    $component = $containerspatcher->getControllerName();
    $action = $containerspatcher->getActionName();
    $role = 'guest';


    if ($di->get('session')->has('auth'))
        $role = $di->get('session')->get('auth')['role'];

//    throw new Error($component.':'.$action.':'.$role);

    if (!$di->get('acl')->isAllowed($role, $component, $action)) {
        if ($role == 'guest') {
            $di->get('flashSession')->error('You must be logged in');
            $containerspatcher->forward([
                'controller' => 'auth',
                'action'     => 'loginForm',
            ]);
        }
        else
            $containerspatcher->forward([
                'controller' => 'admin',
                'action'     => 'index',
            ]);
        return false;
    }

});

//$eventsManager->fire('router:matchedRoute', $di);