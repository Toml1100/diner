<?php
//This is my controller

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);


//Require autoload file
require_once('vendor/autoload.php');



//Start a session (start session after require the autoload.php
session_start();
//var_dump($_SESSION);

//Test my Datalayer Class
$dataLayer = new DataLayer();
$myOrder = new Order("Salad", "Lunch", "dressing, croutons");
$id = $dataLayer->saveOrder($myOrder);
echo "$id inserted successfully";

//Instantiate F3 Base ClassroomAttendance
$f3 = Base::instance();

//Instantiate a controller object
$con = new Controller($f3);

//Define a default route
$f3->route('GET /', function(){

    $GLOBALS['con']->home();

});

//Define a breakfast route
$f3->route('GET /breakfast', function(){
    $GLOBALS['con']->breakfast();


});

//Define a lunch route
$f3->route('GET /lunch', function(){
    $GLOBALS['con']->lunch();

});

//Define an order route
$f3->route('GET|POST /order', function($f3){
    $GLOBALS['con']->order();


});

//define order 2 route
$f3->route('GET|POST /order2', function($f3){
    $GLOBALS['con']->order2();


});

//Define an summary route
$f3->route('GET|POST /summary', function(){

    //Instantiate a view
    $view = new Template();
    echo $view->render("views/summary.html");

    //Destroy session array
    session_destroy();

});

//Run Fat Free
$f3->run();

