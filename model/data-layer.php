<?php
class DataLayer
{
    static function getMeals()
    {
        return array("breakfast", "lunch", "dinner", "desert");
    }

    static function getCondiments()
    {
        return array("ketchup", "mayonaise", "mustard", "ranch");
    }
}

