<?php

namespace Ipsupply\SearchMultipleUsItem;

use Laravel\Nova\Nova;
use Laravel\Nova\Tool;

class SearchMultipleUsItem extends Tool
{
    /**
     * Perform any tasks that need to happen when the tool is booted.
     *
     * @return void
     */
    public function boot()
    {
        Nova::script('search_multiple_us_item', __DIR__.'/../dist/js/tool.js');
        Nova::style('search_multiple_us_item', __DIR__.'/../dist/css/tool.css');
    }

    /**
     * Build the view that renders the navigation links for the tool.
     *
     * @return \Illuminate\View\View
     */
    public function renderNavigation()
    {
        return view('search_multiple_us_item::navigation');
    }
}
