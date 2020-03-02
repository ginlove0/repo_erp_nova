<?php

namespace Ipsupply\CheckoutItemResourceTool;

use Laravel\Nova\Fields\ResourceRelationshipGuesser;
use Laravel\Nova\ResourceTool;

class CheckoutItemResourceTool extends ResourceTool
{
    /**
     * Get the displayable name of the resource tool.
     *
     * @return string
     */
    public function name()
    {
        return 'Checkout Item Resource Tool';
    }

    /**
     * Get the component name for the resource tool.
     *
     * @return string
     */
    public function component()
    {
        return 'checkout-item-resource-tool';
    }




    public $resourceClass;
    public $resourceName;
    public $viaRelationship;
    public $singularLabel;

    public $viaResource;



    public function fromReousrceRelation($resource = null)
    {

        $this->resourceClass = $resource;
        $this->resourceName = $resource::uriKey();

    }

}
