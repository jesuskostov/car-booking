<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;

class Car extends Resource
{

    public static function label() {
        return 'Автомобили';
    }

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Car>
     */
    public static $model = \App\Models\Car::class;

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
            Text::make("Марка", "brand")->sortable(),
            Text::make("Модел", "model")->sortable(),
            Number::make("Година", "year")->sortable(),
            Text::make("Цвят", "color")->sortable(),
            Select::make("Скоростна кутия", "gearbox")->options([
                'Ръчна' => 'Ръчна',
                'Автоматична' => 'Автоматична',
            ])->sortable(),
            Select::make("Тип гориво", "fuel_type")->options([
                'Бензин' => 'Бензин',
                'Дизел' => 'Дизел',
                'Газ' => 'Газ',
                'Електричество' => 'Електричество',
                'Хибрид' => 'Хибрид',
            ])->sortable(),
            Text::make("Градски разход на гориво за 100км", "fuel_consumption_city")->sortable(),
            Text::make("Извънградски разход на гориво за 100км", "fuel_consumption_urban")->sortable(),
            Text::make("Комбинирано разход на гориво за 100км", "fuel_consumption_combined")->sortable(),
            Text::make("Цена за 1 ден", "price_1")->sortable(),
            Text::make("Цена за 2 дни", "price_2")->sortable(),
            Text::make("Цена за 3 дни", "price_3")->sortable(),
            Text::make("Цена за седмица", "price_week")->sortable(),
            Text::make("Цена за месец", "price_month")->sortable(),
            Text::make("Снимка", "image")->sortable(),
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
