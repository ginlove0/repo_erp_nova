<?php


namespace App\Services\Condition;


use App\Models\Condition;

interface ConditionServiceInterface
{
    public function findByName(string $name): Condition;
}