<?php
class Validate
{
    static function validFood($food): bool

    {

        return strlen($food) > 2;
    }

    static function validMeal($meal): bool

    {
        return in_array($meal, DataLayer::getMeals());
    }
}
