<?php


namespace App\Services\Condition;


use App\Models\Condition;

class ConditionService implements ConditionServiceInterface
{

    public function findByName(string $name): Condition
    {
        return Condition::where('name', $name)->firstOrFail();
    }
}