<?php
require_once("Model.php");
require_once("../connection/connection.php");
class Category extends Model{

    private int $id;
    private string $name;

    protected static string $table = "categories";

    public function __construct(array $data){
        $this->id = $data["id"];
        $this->name = $data["name"];
    }

    public function getId(): int{
        return $this->id;
    }
    public function getName(): string{
        return $this->name;
    }
    public function setName(string $name): void{
        $this->name = $name;
    }
    public function toArray(){
        return [$this->id, $this->name];
    }
}