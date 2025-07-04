<?php
//Routing starts here (Mapping between the request and the controller & method names)
//It's an key-value array where the value is an key-value array
//----------------------------------------------------------
$apis = [
    '/articles'         => ['controller' => 'ArticleController', 'method' => 'getAllArticles'],
    '/addNewArticle'=> ['controller'=> 'ArticleController', 'method'=> 'addNewArticle'],
    '/updateArticle'=> ['controller'=> 'ArticleController', 'method'=> 'updateArticle'],
    '/deleteArticle'=> ['controller'=> 'ArticleController', 'method'=> 'deleteArticle'],
    '/deleteArticles'=> ['controller' => 'ArticleController', 'method' => 'deleteAllArticles'],
    
    '/categories'         => ['controller' => 'CategoryController', 'method' => 'getAllCategories'],
    '/addNewCategory'=> ['controller'=> 'CategoryController', 'method'=> 'addNewCategory'],
    '/updateCategory'=> ['controller'=> 'CategoryController', 'method'=> 'updateCategory'],
    '/deleteCategory'=> ['controller'=> 'CategoryController', 'method'=> 'deleteCategory'],
    '/deleteCategories'=> ['controller' => 'CategoryController', 'method' => 'deleteAllCategories'],


    '/articlesOfCategory'=> ['controller'=> 'ArticleController', 'method'=> 'getArticlesOfCategory'],
    

];
