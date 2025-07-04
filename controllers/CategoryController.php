<?php 
require(__DIR__ . "/../models/Category.php");
require(__DIR__ . "/../connection/connection.php");
require(__DIR__ . "/../services/CategoryService.php");
require(__DIR__ . "/./BaseController.php");

class CategoryController extends BaseController{
    public function getAllCategories(){
        try{
            if(!isset($_GET["id"])){
                $categories = Category::all($this->mysqli);
                $categories_array = CategoryService::categoriesToArray($categories); 
                static::success_response($categories_array);
                return; // i removed it from success_response and add it here since it is reaching the else directly
            }
            $id = $_GET["id"];
            $category = Category::find($this->mysqli, $id)->toArray();
            static::success_response($category);
            return;
        }
        catch(Exception $e){
            static::error_response($e->getMessage());
        }
    }
    
    public function addNewCategory(){
        try{
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                $data = json_decode(file_get_contents("php://input"),true);
                $category = Category::add($this->mysqli, $data);
                ($category > 0)?
                    static::success_response("Category Created Successfully"):static::error_response("Failed To Create Category");
        }
    }
    catch(Exception $e){
            static::error_response($e->getMessage());
        }
    }
     public function updateCategory(){
        try{
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                $data = json_decode(file_get_contents("php://input"),true);
                $id =$data['id'];
                if(!isset($id)){
                    static::error_response("Incomplete Request");
                    return;
                }
                if(!Category::find($this->mysqli, $id)){
                static::error_response("Category Not Found!");
                return;
             }
                $record = $data['values'];
                $category = Category::update($this->mysqli, $id,$record);
                ($category > 0)?
                    static::success_response("Category Updated Successfully"):static::error_response("Failed To Update Category");
        }
    }
    
    catch(Exception $e){
            static::error_response($e->getMessage());
        }
    }

    public function deleteCategory(){
        try{
            if($_SERVER['REQUEST_METHOD']=="POST"){
                $data = json_decode(file_get_contents("php://input"),true);
                $id = $data["id"];
                if(!isset($id)){
                static::error_response("Incomplete Request");
                return;
        }
        $found = Category::find($this->mysqli, $id);
        if(!$found){
            static::error_response(message: "Category Not Found!");
            return;
        }
        $category = Category::delete($this->mysqli, $id);
       ($category > 0)?
       static::success_response("Category Deleted Successfully"):static::error_response("Failed To Delete Category");
       return;
    }
        static::error_response(message: "Bad Request!");
        return;

    }
    catch(Exception $e){
        static::error_response($e->getMessage());
    }
    }
    
    public function deleteAllCategories(){
        try{
            if($_SERVER['REQUEST_METHOD']== "POST"){
                $category = Category::deleteAll($this->mysqli);
                $category ? static::success_response("All Categories are Deleted."):static::error_response("Failed to Delete All Categories");
                return;
            }
            else{
                static::error_response(message: "Bad Request!");
                return;
            }
        }
        catch(Exception $e){
            static::error_response($e->getMessage());
        }
    }

}
