<?php
namespace P5\managers;

class Validator
{
  private $sql = ['INSERT', 'UPDATE', 'DELETE', 'WHERE', 'JOIN', 'LIKE', 'OR', 'AND'];

  private $javascript = ['<script>', '</script>'];

  private $safe = '';

  
  public function validateSQL($entry) // "Coucou ;les copains INSERT table INTO tot"
  {
    foreach ($this->sql as $sqlEntry) {
      $this->safe = strtr($sqlEntry, $entry, ''); // est-ce que dans $entry, j'ai une occurence de $sqlEntry ?
    }

    return $this->safe; // "Coucou ;les copains table tot"
  }

  public function validateJavascript()
  {
    foreach ($this->javascript as $js) {
      $this->safe = strtr($js, $entry, ''); // est-ce que dans $entry, j'ai une occurence de $sqlEntry ?
    }

    return $this->safe; // "Coucou ;les copains table tot"
  }
}




      // foreach ($data as $entry) 
      // {
      //    $this->validator->validateSQL($entry);
      //    $this->validator->validateJavascript($entry);
      // }
