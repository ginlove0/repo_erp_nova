<?php
//
//namespace App\Nova\Flexible\Resolvers;
//
//use Illuminate\Support\Facades\Log;
//use Whitecube\NovaFlexibleContent\Value\ResolverInterface;
//
//class SaleOrderModelResolver implements ResolverInterface
//{
//    /**
//     * get the field's value
//     *
//     * @param  mixed  $resource
//     * @param  string $attribute
//     * @param  Whitecube\NovaFlexibleContent\Layouts\Collection $layouts
//     * @return Illuminate\Support\Collection
//     */
//    public function get($resource, $attribute, $layouts)
//    {
//
//
//        $saleordermodels = $resource->saleordermodels()->get();
//
//
//
//
//        return $saleordermodels->map(function($block) use ($layouts) {
//            $layout = $layouts->find("saleordermodel");
//            Log::info($layouts);
//            if(!$layout) return;
//
//            return $layout->duplicateAndHydrate($block->id, ["price" => $block->price, "qty" => $block->qty, "model" => $block->modelId]);
//        })->filter();
//    }
//
//    /**
//     * Set the field's value
//     *
//     * @param  mixed  $model
//     * @param  string $attribute
//     * @param  Illuminate\Support\Collection $groups
//     * @return string
//     */
//    public function set($model, $attribute, $groups)
//    {
//        Log::info('o dayy set');
//
//    }
//}
