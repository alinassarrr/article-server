<?php 

class CategoryService {

    public static function categoriesToArray($categories_db){
        $results = [];

        foreach($categories_db as $a){
             $results[] = $a->toArray(); //hence, we decided to iterate again on the articles array and now to store the result of the toArray() which is an array. 
        } 

        return $results;
    }

}