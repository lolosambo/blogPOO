<?php

namespace P5\core\router;



class Route
{
  private $path; 

  private $action; 

  private $params = []; 

 

  public function __construct($path, $action, $params = null)
  {
    $this->path = $path;
    $this->action = $action;
    $this->params = $params;
  }

  public function getPath() { return $this->path; }
  public function getAction() { return $this->action; }
  public function getParams() { return $this->params; }

  public function setPath($path) { $this->path = $path; }
  public function setAction($action) { $this->action = $action; }
  public function setParams($params) { $this->params = $params; }

  
}



