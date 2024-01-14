<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\DateTime;
// use Car
use App\Models\Car;

use Laravel\Nova\Http\Requests\NovaRequest;

class Booking extends Resource
{

    public static function label() {
        return 'Резервации';
    }

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Booking>
     */
    public static $model = \App\Models\Booking::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
            
            BelongsTo::make('Car')
            ->displayUsing(function ($car) {
                return $car->name_model; // 'name_model' is the accessor in the Car model
            }),

           Date::make('Начална дата', 'start_date')
                ->rules('required', 'after_or_equal:today', function ($attribute, $value, $fail) use ($request) {
                    // Assuming you have a method in Car model to check availability
                    $car = Car::find($request->car_id);
                    if ($car && !$car->isAvailableForDates($value, $request->end_date)) {
                        $fail('The car is not available for the selected start date.');
                    }
                }),

            Date::make('Крайна дата', 'end_date')
                ->rules('required', 'after:start_date', function ($attribute, $value, $fail) use ($request) {
                    $car = Car::find($request->car_id);
                    if ($car && !$car->isAvailableForDates($request->start_date, $value)) {
                        $fail('The car is not available for the selected end date.');
                    }
                }),

        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
