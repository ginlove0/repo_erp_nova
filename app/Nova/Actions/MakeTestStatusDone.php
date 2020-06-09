<?php

namespace App\Nova\Actions;

use App\Models\Item;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class MakeTestStatusDone extends Action
{
    use InteractsWithQueue, Queueable;
    public $name = 'Mark done';

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        //
        foreach ($models as $model)
        {
//            Item::where('id', '=', $model -> id)
//                ->update(['test_status' => 'Need test'], ['timestamps' => false]);
            $model -> test_status = 'Done';
            $model -> timestamps = false;
            $model -> save();

        }
        return Action::message('Update test status to Done success!');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [];
    }
}
