<?php

namespace App\Nova\Flexible\Layouts;

use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Text;
use Whitecube\NovaFlexibleContent\Layouts\Layout;

class SaleOrderModel extends Layout
{
    /**
     * The layout's unique identifier
     *
     * @var string
     */
    protected $name = 'saleordermodel';

    /**
     * The displayed title
     *
     * @var string
     */
    protected $title = 'SaleOrderModel';

    /**
     * Get the fields displayed by the layout.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Text::make('Price', 'price'),
            Text::make('Quantity', 'qty'),
            BelongsTo::make('Model')
        ];
    }

}
