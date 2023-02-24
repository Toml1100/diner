<?php
//This is my controller

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);


//Require autoload file
require_once('vendor/autoload.php');
//require_once('model/data-layer.php');
//require_once('model/validate.php');
//require_once('classes/order.php');

//Start a session (start session after require the autoload.php
session_start();
//var_dump($_SESSION);

//Instantiate F3 Base Class
$f3 = Base::instance();

//Instantiate a controller object
$con = new Controller($f3);

//Define a default route
$f3->route('GET /', function(){

    $GLOBALS['con']->home();

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

        $newOrder = new Order();

        $food = trim($_POST['food']);
        if(Validate::validFood($food)){
            $newOrder->setFood($food);
        }
        else {
            $f3->set('errors["food"]', 'Food must have at least 2 characters');
        }
        //Move the data from Post array to the SESSION array
        //validate the meal
        $meal = $_POST['meal'];
        if (Validate::validMeal($meal)){
            $newOrder->setMeal($meal);
        } else {
            $f3->set('errors["meal"]', 'Meal is invalid');
        }



        if (empty($f3->get('errors'))){
            $_SESSION['newOrder'] = $newOrder;
            //Redirect to summary page
            $f3->reroute('order2');
        }




    }

    //Add Meals to F3 hive
    $f3->set('meals', DataLayer::getMeals());

    //Instantiate a view
    $view = new Template();
    echo $view->render("views/order_form1.html");

});

//define order 2 route
$f3->route('GET|POST /order2', function($f3){
    //If the form has been submitted
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $condString = implode(", ",$_POST['condiment']);
        $_SESSION['newOrder']->setCondiments($condString);
        //Move the data from Post array to the SESSION array
//        $_SESSION['condiment'] = $_POST['condiment'];

        //Redirect to summary page
        $f3->reroute('summary');
    }
    //Add Meals to F3 hive
    $f3->set('condiments', DataLayer::getCondiments());

    //Instantiate a view
    $view = new Template();
    echo $view->render("views/order-form2.html");

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

