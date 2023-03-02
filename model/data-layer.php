<?php
//connect to db
require $_SERVER['DOCUMENT_ROOT'].'/../config.php';
class DataLayer
{
    // Database Connection Object
    private $_dbh;
    function __construct()
    {
        try{
            //Instantiate a database object
            $this->_dbh = new PDO ( DB_DSN, DB_USERNAME, DB_PASSWORD );
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    function saveOrder($orderObj)
    {
        //1. Define the Query
        $sql = "INSERT INTO orders (food, meal, conds) VALUES (:food, :meal , :conds)";
        //2. Prepare the Statement
        $statement = $this->_dbh->prepare($sql);
        //3. Bind the parameters
        $food = $orderObj->getFood();
        $meal = $orderObj->getMeal();
        $condiments = $orderObj->getCondiments();
        $statement->bindParam(':food', $food);
        $statement->bindParam(':meal', $meal);
        $statement->bindParam(':conds', $condiments);
        //4. Execute the query
        $statement->execute();
        //5. Process the results
        $id = $this->_dbh->lastInsertId();
        return $id;
    }
    static function getMeals()
    {
        return array("breakfast", "lunch", "dinner", "desert");
    }

    static function getCondiments()
    {
        return array("ketchup", "mayonaise", "mustard", "ranch");
    }
}

