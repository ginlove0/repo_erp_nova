<?php

namespace App\Nova\Filters;

use App\Models\Item;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class ModelUSHaveItemFilter extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'select-filter';

    public function default()
    {
        return 1;
    }

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
        $modelIds = Item::where('stockStatus', '=', true)
            ->where('whlocationId', '=', 2)
            ->groupBy('modelId')
            ->pluck('modelId');


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
        return ['Model With Item Only'=>1];
    }
}
