<?php
	
namespace p5\builders;


class Builder
{
	private $object;
	private $type;

	
     public function createFrontController($type)
    {
	  $this->type = ucfirst($type);
	  $class = 'p5\\controllers\\frontend\\'.$this->type.'Controller';
      $this->object = new $class();

      return $this;
    }
    
     public function createBackController($type)
    {
	  $this->type = ucfirst($type);
	  $class = 'p5\\controllers\\backend\\Admin'.$this->type.'Controller';
      $this->object = new $class();

      return $this;
    }
    
     public function createManager($type)
    {
	  $this->type = ucfirst($type);
	  $class = 'p5\\managers\\'.$this->type.'Manager';
      $this->object = new $class();

      return $this;
    }
    
    public function createEntities($type, array $data)
    {
	  $this->type = ucfirst($type);
	  $class = 'p5\\entities\\'.$this->type;
      $this->object = new $class($data);

      return $this;
    }
    
     public function createApp($type)
    {
	  $this->type = ucfirst($type);
	  $class = 'p5\\app\\'.$this->type;
      $this->object = new $class();

      return $this;
    }

    public function setObject(object $type)
    {
      $this->object = $type;

      return $this;
    }

    public function build()
    {
      return $this->object;
    }
}