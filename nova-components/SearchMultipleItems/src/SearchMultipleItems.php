<?php

namespace Ipsupplt\SearchMultipleItems;

use Laravel\Nova\Nova;
use Laravel\Nova\Tool;

class SearchMultipleItems extends Tool
{
    /**
     * Perform any tasks that need to happen when the tool is booted.
     *
     * @return void
     */
    public function boot()
    {
        Nova::script('search-multiple-items', __DIR__.'/../dist/js/tool.js');
        Nova::style('search-multiple-items', __DIR__.'/../dist/css/tool.css');
    }

    /**
     * Build the view that renders the navigation links for the tool.
     *
     * @return \Illuminate\View\View
     */
    public function renderNavigation()
    {
        return view('search-multiple-items::navigation');
    }
}
