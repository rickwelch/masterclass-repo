<?php
/**
 * Created by PhpStorm.
 * User: welch
 * Date: 2/13/15
 * Time: 7:33 PM
 */

namespace Masterclass\Router\Route;


class GetRoute extends AbstractRoute {

  public function matchRoute($requestPath, $requestType){
    if($requestType != 'GET'){
      return false;
    }

    if($this->routePath != $requestPath){
      return false;
    }

    return true;
  }
}