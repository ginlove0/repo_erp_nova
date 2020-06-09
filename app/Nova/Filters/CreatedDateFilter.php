<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Filters\DateFilter;

class CreatedDateFilter extends DateFilter
{
    /**
     * Apply the filter to the given query.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */

    public $name = 'Updated date filter';

    public function apply(Request $request, $query, $value)
    {
        $value = Carbon::parse($value);
        return $query->whereDate('updated_at', '=', $value);

    }
}
