<?php
//This is my controller

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require autoload file
require_once('vendor/autoload.php');

//Instantiate F3 Base Class
$f3 = Base::instance();

//Define a default route
$f3->route('GET /', function(){

    //Instantiate a view
    $view = new Template();
    echo $view->render("views/diner-home.html");

});

//Define a breakfast route
$f3->route('GET /breakfast', function(){

    //Instantiate a view
    $view = new Template();
    echo $view->render("views/breakfast.html");

});

//Define a lunch route
$f3->route('GET /lunch', function(){

    //Instantiate a view
    $view = new Template();
    echo $view->render("views/lunch.html");

});

//Run Fat Free
$f3->run();

