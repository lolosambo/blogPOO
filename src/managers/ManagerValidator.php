<?php
namespace P5\managers;

class ManagerValidator {

  private $sql = ['INSERT', 'INTO', 'ORDER BY', 'LIMIT', 'FROM', 'SET', 'UPDATE', 'DELETE', 'WHERE', 'JOIN', 'LIKE', 'OR', 'AND'];
  private $javascript = ['<script>', '</script>'];
  private $safe;


  public function validateSQL($entry) {
      $this->safe = str_replace($this->sql, "", $entry);
      return $this->safe;
  }

  public function validateJavascript($entry) {
      $this->safe = str_replace($this->javascript, "", $entry);
      return $this->safe;
  }
}




