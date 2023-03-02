<?php

//328/diner/controller/controller.php

class Controller
{
    private $_f3; //Fat-Free object

    function __construct($f3)
    {
        $this->_f3 = $f3;
    }

    function home()
    {
        //Instantiate a view
        $view = new Template();
        echo $view->render("views/diner-home.html");
    }

    function breakfast()
    {
        //Instantiate a view
        $view = new Template();
        echo $view->render("views/breakfast.html");
    }

    function lunch()
    {
        //Instantiate a view
        $view = new Template();
        echo $view->render("views/lunch.html");
    }

    function order($f3)
    {
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
    }

    function order2($f3)
    {
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
    }
}