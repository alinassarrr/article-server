<?php 
require("../connection/connection.php");


$query = "ALTER TABLE articles ADD category_id INT(11) NOT NULL";

$execute = $mysqli->prepare($query);
$execute->execute();