<?php
namespace P5\managers;

class ManagerValidator {

  private $sql = ['INSERT', 'UPDATE', 'DELETE', 'WHERE', 'JOIN', 'LIKE', 'OR', 'AND'];
  private $javascript = ['<script>', '</script>'];
  private $safe;

  public function validate($entry) {

      $entryVal = $this->validateSQL($entry);

      $entryVal = $this->validateJavascript($entry);
      return $entryVal;
  }


  private function validateSQL($entry) {
      foreach ($this->sql as $sql) {
          $this->safe = strtr($sql, $entry, '');
          var_dump($this->safe);
      }
      return $this->safe;
  }

  private function validateJavascript($entry) {
    foreach ($this->javascript as $js) {
        $this->safe = strtr($js, $entry, '');
    }

    return $this->safe;
  }
}




