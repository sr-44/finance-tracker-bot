<?php

namespace App\Enums;

class ExpenseCategoryEnum
{
    public const FOOD = 'food';
    public const TRANSPORT = 'transport';
    public const HOUSING = 'housing';
    public const HEALTH = 'health';
    public const TRAVEL = 'travel';
    public const EDUCATION = 'education';
    public const HOBBIES = 'hobbies';
    public const GIFTS = 'gifts';
    public const ELECTRONICS = 'electronics';
    public const ETC = 'etc';


    public static function getAll(): array
    {
        $reflectionClass = new \ReflectionClass(__CLASS__);
        return array_values($reflectionClass->getConstants());
    }
}