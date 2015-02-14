<?php
/**
 * Created by PhpStorm.
 * User: welch
 * Date: 2/13/15
 * Time: 7:36 PM
 */

namespace Masterclass\Router\Route;


class PostRoute extends AbstractRoute{

  public function matchRoute($requestPath, $requestType){
    if($requestType != 'POST'){
      return false;
    }

    if($this->routePath != $requestPath){
      return false;
    }

    return true;
  }


} 