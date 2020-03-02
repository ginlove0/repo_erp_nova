<?php

namespace Ipsupply\SaleOrderModelsField;

use Laravel\Nova\Fields\Field;
use Laravel\Nova\Fields\ResourceRelationshipGuesser;

class SaleOrderModelsField extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'sale-order-models-field';


    public $resourceClass;
    public $resourceName;
    public $viaRelationship;
    public $singularLabel;

    public $viaResource;
    public $hasManyRelationship;

//
//    /**
//     *
//     *
//     * @param  string  $name
//     * @param  string|null  $attribute
//     * @param  string|null  $resource
//     * @return void
//     */
    public function __construct(string $name, $attribute = null, $resource = null)
    {
        parent::__construct($name, $attribute);

        $this->hideFromIndex();
        $this->showOnDetail();
        $this->hideWhenCreating();
        $this->hideWhenUpdating();

        $resource = $resource ?? ResourceRelationshipGuesser::guessResource($name);

        $this->resourceClass = $resource;
        $this->resourceName = $resource::uriKey();
        $this->viaRelationship = $this->attribute;
        $this->hasManyRelationship = $this->attribute;
    }
}
