<?php

declare(strict_types=1);

namespace App\Models;

use Nette;

class ProductsModel{
    use Nette\SmartObject;
    private $tableName = "produkty";
    private $database;
    public function __construct(Nette\Database\Explorer $database){
        $this->database = $database;
    }

    public function createProduct($data){
        $this->database->table($this->tableName)->insert($data);
    }
    public function getProducts(){
        return $this->database->table($this->tableName);
    }
    public function updateProduct($data){
        $this->database->table($this->tableName)->where('id', $data['id'])->update($data);
    }
    public function removeProduct($data){
        $this->database->table($this->tableName)->where('id', $data['id'])->delete();
    }
}