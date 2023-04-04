<?php
    $index = $_GET['index'];
 
    $data = file_get_contents('articles.json');
    $data = json_decode($data);
 
    unset($data[$index]);
 
    $data = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents('articles.json', $data);
 
    header('location: index.php');
?>