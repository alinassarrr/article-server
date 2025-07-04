<?php 
require(__DIR__ . "/../models/Article.php");
require(__DIR__ . "/../connection/connection.php");
require(__DIR__ . "/../services/ArticleService.php");
require(__DIR__ . "/./BaseController.php");

class ArticleController extends BaseController{
    public function getAllArticles(){
        try{
            if(!isset($_GET["id"])){
                $articles = Article::all($this->mysqli);
                $articles_array = ArticleService::articlesToArray($articles); 
                static::success_response($articles_array);
                return; // i removed it from success_response and add it here since it is reaching the else directly
            }
            $id = $_GET["id"];
            $article = Article::find($this->mysqli, $id)->toArray();
            static::success_response($article);
            return;
        }
        catch(Exception $e){
            static::error_response($e->getMessage());
        }
    }
    
    public function addNewArticle(){
        try{
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                $data = json_decode(file_get_contents("php://input"),true);
                $article = Article::add($this->mysqli, $data);
                ($article > 0)?
                    static::success_response("Article Created Successfully"):static::error_response("Failed To Create Article");
        }
    }
    catch(Exception $e){
            static::error_response($e->getMessage());
        }
    }
     public function updateArticle(){
        try{
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                $data = json_decode(file_get_contents("php://input"),true);
                $id =$data['id'];
                if(!isset($id)){
                    static::error_response("Incomplete Request");
                    return;
                }
                if(!Article::find($this->mysqli, $id)){
                static::error_response("Article Not Found!");
                return;
             }
                $record = $data['values'];
                $article = Article::update($this->mysqli, $id,$record);
                ($article > 0)?
                    static::success_response("Article Updated Successfully"):static::error_response("Failed To Update Article");
        }
    }
    
    catch(Exception $e){
            static::error_response($e->getMessage());
        }
    }

    public function deleteArticle(){
        try{
            if($_SERVER['REQUEST_METHOD']=="POST"){
                $data = json_decode(file_get_contents("php://input"),true);
                $id = $data["id"];
                if(!isset($id)){
                static::error_response("Incomplete Request");
                return;
        }
        $found = Article::find($this->mysqli, $id);
        if(!$found){
            static::error_response(message: "Article Not Found!");
            return;
        }
        $article = Article::delete($this->mysqli, $id);
       ($article > 0)?
       static::success_response("Article Deleted Successfully"):static::error_response("Failed To Delete Article");
       return;
    }
    static::error_response(message: "Bad Request!");
    return;
    
}
catch(Exception $e){
    static::error_response($e->getMessage());
}
}

public function deleteAllArticles(){
        try{
            if($_SERVER['REQUEST_METHOD']== "POST"){
                $article = Article::deleteAll($this->mysqli);
                $article ? static::success_response("All Articles are Deleted."):static::error_response("Failed to Delete All Articles");
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

    public function getArticlesOfCategory(){
        try{
            if($_SERVER['REQUEST_METHOD']== "POST"){
                $data = json_decode(file_get_contents("php://input"),true);
                $articles = Article::getAllByCategory($this->mysqli,$data["id"]);
                $article_array = ArticleService::articlesToArray($articles);
                (count($article_array)>0)?static::success_response($article_array):static::success_response("No Result Found");
                return;
            }
        }
        catch(Exception $e){
            static::error_response($e->getMessage());
        }
    
    }
}
