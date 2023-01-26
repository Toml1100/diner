<?php
//This is my controller

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Start a session
session_start();

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

//Define an order route
$f3->route('GET|POST /order', function($f3){
    //If the form has been submitted
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        //Move the data from Post array to the SESSION array
        $_SESSION['food'] = $_POST['food'];
        $_SESSION['meal'] = $_POST['meal'];

        //Redirect to summary page
        $f3->reroute('summary');
    }
    //Instantiate a view
    $view = new Template();
    echo $view->render("views/order_form1.html");

});

//Define an summary route
$f3->route('GET|POST /summary', function(){

    //Instantiate a view
    $view = new Template();
    echo $view->render("views/summary.html");

});

//Run Fat Free
$f3->run();

