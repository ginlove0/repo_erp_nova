<?php

namespace Ipsupply\AddItemWithoutSn;

use Laravel\Nova\Nova;
use Laravel\Nova\Tool;

class AddItemWithoutSn extends Tool
{
    /**
     * Perform any tasks that need to happen when the tool is booted.
     *
     * @return void
     */
    public function boot()
    {
        Nova::script('add-item-without-sn', __DIR__.'/../dist/js/tool.js');
        Nova::style('add-item-without-sn', __DIR__.'/../dist/css/tool.css');
    }

    /**
     * Build the view that renders the navigation links for the tool.
     *
     * @return \Illuminate\View\View
     */
    public function renderNavigation()
    {
        return view('add-item-without-sn::navigation');
    }
}
