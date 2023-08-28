<?php

namespace App\Enums;

class IncomeCategoryEnum
{
    public const SALARY = 'salary';
    public const SALES = 'sales';
    public const ETC = 'etc';

    public static function getAll(): array
    {
        $reflectionClass = new \ReflectionClass(__CLASS__);
        return array_values($reflectionClass->getConstants());
    }
}