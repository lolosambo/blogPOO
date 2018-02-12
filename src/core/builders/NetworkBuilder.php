<?php
	
namespace P5\core\builders;
use P5\entities\Networks;

class NetworkBuilder

{
    private $network;
    
    
    public function create(array $network)
    {
      $this->network = new Networks($network);
      return $this;
    }
    
    
    public function setNetwork(Networks $network)
    {
      $this->network = $network;
      return $this;
    }
    
    
    public function build()
    {
      return $this->network;
    }
    
    
}