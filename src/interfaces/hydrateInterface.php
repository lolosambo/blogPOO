<?php

namespace blog\interfaces;


interface hydrate
{
  public function hydrate(array $donnees)
  {
      foreach ($donnees as $key => $value)
      {
          $method = 'set'.ucfirst($key);

          if (method_exists($this, $method))
          {
            $this->$method($value);
          }
      }
  }

}



?>