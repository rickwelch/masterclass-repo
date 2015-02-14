<?php
/**
 * Created by PhpStorm.
 * User: welch
 * Date: 2/13/15
 * Time: 7:43 PM
 */

namespace Masterclass\Router\Route;

interface RouteInterface{

  public function matchRoute($requestPath, $requestType);

  public function getRoutePath();

  public function getRouteClass();

}