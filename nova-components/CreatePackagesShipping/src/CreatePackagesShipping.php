<?php

namespace Ipsupply\CreatePackagesShipping;

use Laravel\Nova\Fields\Field;

class CreatePackagesShipping extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'create-packages-shipping';


    public function __construct($name, $attribute = null, callable $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);
    }
}
