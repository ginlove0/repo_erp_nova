<?php

namespace App\Http\Controllers;

use App\Services\Condition\ConditionServiceInterface;

class ConditionController extends Controller
{
    private $conditionService;
    public function __construct(ConditionServiceInterface $conditionService)
    {
        $this -> conditionService = $conditionService;
    }

    public function showCondition($name)
    {
        return $this-> conditionService->findByName($name);
    }
}
