<?php

require_once "JSONDatabaseHandler.php";

class Database {
    public function connect() {
        $database = new JSONDatabaseHandler(PUBLIC_FOLDER . "data.json");
        return $database;
    }

    public function compareIdsDescending($a, $b) {
      if ($a['id'] == $b['id']) {
          return 0;
      }
      return ($a['id'] > $b['id']) ? -1 : 1;
    }
}