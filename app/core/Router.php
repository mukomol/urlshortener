<?php


class Router {

  private $routes;

  function add_route($route, callable $closure) {
    $this->routes[$route] = $closure;
  }

  function execute() {

    $path = !empty($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : (!empty($_SERVER['ORIG_PATH_INFO']) ? $_SERVER['ORIG_PATH_INFO'] : '');

    if(array_key_exists($path, $this->routes)) {
      $this->routes[$path]();
    } else {
      $this->routes['/']();
    }
  }
}