<?php

namespace App\Http\Livewire;

use App\Models\RiverLevel;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class RiverLevelPowerGrid extends PowerGridComponent
{
    use ActionButton;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */

    /**
    * PowerGrid datasource.
    *
    * @return Builder<\App\Models\RiverLevel>
    */
    public function datasource(): Builder
    {
        return RiverLevel::query();
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    | ❗ IMPORTANT: When using closures, you must escape any value coming from
    |    the database using the `e()` Laravel Helper function.
    |
    */
    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('id')
            ->addColumn('river_status')
            ->addColumn('river_level')
            ->addColumn('year')
            ->addColumn('month')

           /** Example of custom column using a closure **/
            ->addColumn('month_lower', function (RiverLevel $model) {
                return strtolower(e($model->month));
            })

            ->addColumn('day')
            ->addColumn('time')
            ->addColumn('date_formatted', fn (RiverLevel $model) => Carbon::parse($model->date)->format('d/m/Y'))
            ->addColumn('created_at_formatted', fn (RiverLevel $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'))
            ->addColumn('updated_at_formatted', fn (RiverLevel $model) => Carbon::parse($model->updated_at)->format('d/m/Y H:i:s'));
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

     /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {
        return [
            Column::make('River Level ID', 'id'),
                // ->makeInputRange(),

            Column::make('RIVER STATUS', 'river_status')
                // ->sortable()
                ->searchable(),

            Column::make('RIVER LEVEL', 'river_level')
                // ->sortable()
                ->searchable(),

            Column::make('YEAR', 'year'),
                // ->makeInputRange(),

            Column::make('MONTH', 'month')
                // ->sortable()
                // ->makeInputText()
                ->searchable(),

            Column::make('DAY', 'day'),
                // ->makeInputRange(),

            Column::make('TIME', 'time')
                // ->sortable()
                ->searchable(),

            Column::make('DATE', 'date_formatted', 'date')
                ->searchable(),
                // ->sortable()
                // ->makeInputDatePicker(),

            Column::make('CREATED AT', 'created_at_formatted', 'created_at'),
                // ->searchable()
                // ->sortable()
                // ->makeInputDatePicker(),

            Column::make('UPDATED AT', 'updated_at_formatted', 'updated_at'),
                // ->searchable()
                // ->sortable()
                // ->makeInputDatePicker(),

        ]
;
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

     /**
     * PowerGrid RiverLevel Action Buttons.
     *
     * @return array<int, Button>
     */

    /*
    public function actions(): array
    {
       return [
           Button::make('edit', 'Edit')
               ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
               ->route('river-level.edit', ['river-level' => 'id']),

           Button::make('destroy', 'Delete')
               ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
               ->route('river-level.destroy', ['river-level' => 'id'])
               ->method('delete')
        ];
    }
    */

    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

     /**
     * PowerGrid RiverLevel Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($river-level) => $river-level->id === 1)
                ->hide(),
        ];
    }
    */
}