<?php

class Database {
    public function connect() {
        $database = new JSONDatabaseHandler(getcwd() . "/data.json");
        return $database;
    }
}