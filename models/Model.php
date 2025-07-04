<?php 
abstract class Model{

    protected static string $table;
    protected static string $primary_key = "id";

    public static function find(mysqli $mysqli, int $id){
        $sql = sprintf("Select * from %s WHERE %s = ?", 
                        static::$table, 
                        static::$primary_key);
        
        $query = $mysqli->prepare($sql);
        $query->bind_param("i", $id);
        $query->execute();

        $data = $query->get_result()->fetch_assoc();

        return $data ? new static($data) : null;
    }

    public static function all(mysqli $mysqli){
        $sql = sprintf("Select * from %s", static::$table);
        
        $query = $mysqli->prepare($sql);
        $query->execute();

        $data = $query->get_result();

        $objects = [];
        while($row = $data->fetch_assoc()){
            $objects[] = new static($row); //creating an object of type "static" / "parent" and adding the object to the array
        }

        return $objects; //we are returning an array of objects!!!!!!!!
    }

    // public static function create(mysqli $mysqli,array $data){
    //     $query = sprintf("INSERT INTO `sttic::$table` (".implode()") VALUES(?)",static::$table);
    //     $stmt = $mysqli->prepare($query);
    //     for($i = 0; $i < count($data); $i++){
    //         $stmt->bind_param("", $key, $value);
    //     }
    // }


    public static function add(mysqli $mysqli,array $data){
        
            $columns = [];
            $params = [];
            foreach($data as $record => $value){
                $columns[] = "`$record`";
                $params[] = $value;
            }
            $count = count($columns);
            $columns = implode(", ", $columns);
            $placeholder = implode(", ",array_fill(0, $count,"?"));
            $query = sprintf("INSERT INTO %s (%s) VALUES (%s)",static::$table,$columns, $placeholder);
            $stmt= $mysqli->prepare($query);
            $stmt->bind_param(str_repeat("s", $count), ...$params);
            $stmt->execute();
            return $stmt->affected_rows;
        }
       



}
           
    

    //you have to continue with the same mindset
    //Find a solution for sending the $mysqli everytime... 
    //Implement the following: 
    //1- update() -> non-static function 
    //2- create() -> static function
    //3- delete() -> static function 
    