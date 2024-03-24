<?php

require_once "JSONDatabaseHandler.php";

class Database {
    public function connect() {
        $database = new JSONDatabaseHandler(PUBLIC_FOLDER . "data.json");
        return $database;
    }
}