<?php
require_once("Model.php");

class Article extends Model{

    private int $id; 
    private string $name; 
    private string $author; 
    private string $description; 
    private int $category_id;
    
    protected static string $table = "articles";

    public function __construct(array $data){
        $this->id = $data["id"];
        $this->name = $data["name"];
        $this->author = $data["author"];
        $this->description = $data["description"];
        $this->category_id= $data["category_id"];
    }

    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getAuthor(): string {
        return $this->author;
    }

    public function getDescription(): string {
        return $this->description;
    }
    public function getCategoryId(): int {
        return $this->category_id;
    }

    public function setName(string $name){
        $this->name = $name;
    }

    public function setAuthor(string $author){
        $this->author = $author;
    }

    public function setDescription(string $description){
        $this->description = $description;
    }
    public function setCategoryId(int $category_id){
        $this->category_id = $category_id;
    }

    public function toArray(){
        return [$this->id, $this->name, $this->author, $this->description,$this->category_id];
    }
   public static function getAllByCategory(mysqli $mysqli, int $category_id) {
        $query = "SELECT * FROM articles WHERE category_id = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $category_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $articles = [];
        while ($row = $result->fetch_assoc()) {
            $articles[] = new static($row);
        }   

        return $articles;
}
    public static function getCategory(mysqli $mysqli, int $id) {
        $query = "SELECT categories.name FROM categories JOIN articles ON articles.category_id = categories.id WHERE articles.id = ?";                               
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result;
}
}