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

    '/login'         => ['controller' => 'AuthController', 'method' => 'login'],
    '/register'         => ['controller' => 'AuthController', 'method' => 'register'],
];
