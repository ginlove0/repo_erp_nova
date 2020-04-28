<?php

namespace App\Nova\Filters;

use App\Models\Item;
use App\Models\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Laravel\Nova\Filters\Filter;
use Illuminate\Support\Facades\DB;

class ModelHaveItemFilter extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'select-filter';



    /**
     * Apply the filter to the given query.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Request $request, $query, $value)
    {
        $modelIds = Item::whereNotNull('serialNumber')
            ->where('stockStatus', '=', true)
            ->groupBy('modelId')
            ->pluck('modelId');

        Log::info($modelIds);

        return $query
            ->whereIn('id', $modelIds);
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request)
    {
//

        return ['Model With Item Only'=>1];

    }

    public function default()
    {
        return true;
    }


}
