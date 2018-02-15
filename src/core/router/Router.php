<?php
namespace P5\core\router;

use P5\core\factories\ControllerFactory;

class Router
{

  private $routes = [];  

  public function __construct()
  {
    $this->loadRoutes(); 
    
  }

  public function loadRoutes()
  {
    $routes = require __DIR__ . '../../../../config/Routes.php'; 

    foreach ($routes as $route) {
      $this->routes[] = new Route($route['path'], $route['action'], $route['params']);
    }
  }


  public function match($url)
  {
    preg_match('#^/(([a-z-A-Z0-9_-]*)/)*#', $url, $path);  // URL with slash 
    preg_match('#([0-9a-zA-Z-_]+)$#', $url, $params); // URL last parameter without slash
    

    foreach ($this->routes as $route) {

      $savedPath = $route->getPath(); 
      preg_match('#(:[a-z]+)$#', $savedPath, $id);  // extract the  "/:id"

      switch ($url) {    
          case !empty($id) : // if URL has parameter
              $compare = $path[0].$id[0]; // path rebuild by Adding URL and "/:id"
              if ($compare === $savedPath) {
                  $value = preg_replace('#$id[0]$#', '#$params$[0]#', $url);  //  replace  /:id by his start value
                  $route->setPath($value); // affect the result to the Route Object path attribute
                  $regex = $route->getParams()[':id'];
                  if (preg_match($regex, $params[0]) !== false) {
                    $route->setParams($params[1])[':id']; // affect parameter's value in the Route Object $params attribute
                  } else {
                    echo 'Mauvais paramètre choisi';
                  }
                  return $route; // return Route Object to use his methods in the HandleRequest Method'
              }
          
          break;
          case empty($id) :  // if URL has no parameter
             if (($path[0] === $savedPath) && ($path[0] === $url)) {  
                   return $route; //  return Route Object to use his methods in the HandleRequest Method'
             }
          break;
          default : return false; // 
          break;  
      }
    }
  }


  public function handleRequest($url, $method)
  {
    
    
    $route = $this->match($url, $method);
 

    if ($route === false)
    {
      echo 'Pas de route pour cette URL';
    }


    else
    {
      $action = $route->getAction();
      $controller = new $action();
      $controller();
    }
  }
}
