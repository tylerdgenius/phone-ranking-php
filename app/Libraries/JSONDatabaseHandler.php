<?php

class JSONDatabaseHandler {
    private $filename;
    
    public function __construct($filename) {
        $this->filename = $filename;
    }
    
    public function read() {
        $contents = file_get_contents($this->filename);
        return json_decode($contents, true);
    }
    
    public function write($data) {
        $json = json_encode($data);
        file_put_contents($this->filename, $json);
    }
    
    public function create($collection, $record) {
        $data = $this->read();
        if (!isset($data[$collection])) {
            $data[$collection] = [];
        }
        $data[$collection][] = $record;
        $this->write($data);
    }
    
    public function readAll($collection) {
        $data = $this->read();
        return isset($data[$collection]) ? $data[$collection] : [];
    }
    
    public function update($collection, $index, $record) {
        $data = $this->read();
        if (isset($data[$collection][$index])) {
            $data[$collection][$index] = $record;
            $this->write($data);
            return true;
        }
        return false;
    }
    
    public function delete($collection, $index) {
        $data = $this->read();
        if (isset($data[$collection][$index])) {
            unset($data[$collection][$index]);
            $data[$collection] = array_values($data[$collection]); // reindex the array
            $this->write($data);
            return true;
        }
        return false;
    }
}