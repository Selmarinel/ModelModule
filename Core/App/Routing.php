<?php
/**
 * Created by PhpStorm.
 * User: Nerdjin
 * Date: 02.04.2016
 * Time: 13:58
 */

function get_route($uri)
{
    $uri = explode('?', $uri);
    $uri = $uri[0];
    global $ROUTE;
    $routes = $ROUTE;
    foreach ($routes as $rUri => $rRoute) {
        if (preg_match("#^{$rUri}$#Ui", $uri)) {
            $route = preg_replace("#^{$rUri}$#Ui", $rRoute, $uri);
            break;
        }
    }
    $route = explode('/', $route);
    $return['controller'] = array_shift($route);
    $return['action'] = array_shift($route);
    $return['params'] = empty($route) ? array() : $route;
    return $return;
}

function get_view($data, $layout = '_default')
{
    include_once ROOT_DIR . 'Core/views/' . $layout . '.my.php';
    return true;
}
