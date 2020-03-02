<?php

namespace Ipsupply\CreatableHasmanyRelationField;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Laravel\Nova\Fields\Field;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\MorphTo;
use Laravel\Nova\Fields\ResourceRelationshipGuesser;
use Laravel\Nova\Http\Requests\CreateResourceRequest;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Nova;

class CreatableHasmanyRelationField extends Field
{



    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'creatable-hasmany-relation-field';





    /**
     * Fills the attributes of the model within the container if the dependencies for the container are satisfied.
     *
     * @param NovaRequest $request
     * @param string $requestAttribute
     * @param object $model
     * @param string $attribute
     */
    protected function fillAttributeFromRequest(NovaRequest $request, $requestAttribute, $model, $attribute)
    {
        Log::info("O day");
        Log::info($request);
        Log::info($requestAttribute);
        Log::info($model);
        Log::info($attribute);
        Log::info('End');

    }



}
