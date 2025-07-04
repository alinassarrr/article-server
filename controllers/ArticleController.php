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
     

    public function deleteAllArticles(){
        die("Deleting...");
    }
}

//To-Do:

//1- Try/Catch in controllers ONLY!!! 
//2- Find a way to remove the hard coded response code (from ResponseService.php)
//3- Include the routes file (api.php) in the (index.php) -- In other words, seperate the routing from the index (which is the engine)
//4- Create a BaseController and clean some imports 