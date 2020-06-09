<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Laravel\Nova\Filters\Filter;

class FilterByTodayAndYesterdayItem extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public function default()
    {
        return true;
    }

    public $component = 'select-filter';

    public $name = 'Today and yesterday only';

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
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();
        return $query->whereDate('updated_at', '<=', $today)->where('updated_at', '>=', $yesterday);
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request)
    {
        return [];
    }
}
