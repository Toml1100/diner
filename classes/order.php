<?php
/**
 * Order ClassroomAttendance REpresents an ORder for my Diner
 * @Thomas Loudon
 */

class Order
{
    private $_food;
    private $_meal;
    private $_condiments;

    function __construct($food= "", $meal="", $condiments="")
    {
        $this->_food = $food;
        $this->_meal = $meal;
        $this->_condiments = $condiments;
    }

    /**
     * getFood returns the food ordered
     * @return string
     */

    public function getFood(): string
    {
        return $this->_food;
    }

    /**
     * setFood sets the food in the order
     * @param $food
     * @return void
     */

    public function setFood($food): void
    {
        $this->_food = $food;
    }

    public function getMeal(): string
    {
        return $this->_meal;
    }

    /**
     * setFood sets the food in the order
     * @param $meal
     * @return void
     */

    public function setMeal($meal): void
    {
        $this->_meal = $meal;
    }

    public function getCondiments(): string
    {
        return $this->_condiments;
    }

    /**
     * setFood sets the food in the order
     * @param $condiments
     * @return void
     */

    public function setCondiments($condiments): void
    {
        $this->_condiments = $condiments;
    }

}