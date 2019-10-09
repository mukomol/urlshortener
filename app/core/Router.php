<?php

class Router {

  private $routes;

  function add_route($route, callable $closure, $view) {

    $arrArgs = [
      'route' => $closure,
      'view' => $view
    ];

    $this->routes[$route] = $arrArgs;
  }

  function execute() {
    $v = new View();
    $path = !empty($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : (!empty($_SERVER['ORIG_PATH_INFO']) ? $_SERVER['ORIG_PATH_INFO'] : '/');

    if(array_key_exists($path, $this->routes)) {
      $this->routes[$path]['route']();
      $v->generate($this->routes[$path]['view']);
    }
    else {
      $this->routes['/'];
      $v->generate($this->routes[$path]['view']);
    }
  }
}