<?php

namespace App\Classes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FilterClass
{
    public static function getTableColumns(Model $table, $exceptColumns = [], $additionalColumns = [], $replaces = ['key' => [], 'value' => []])
    {
        $columns = DB::getSchemaBuilder()->getColumnListing($table->getTable());
        array_push($exceptColumns, 'id', 'updated_at', 'deleted_at');
        $columns = array_merge($columns, $additionalColumns);
        $result = [];
        $replace_key = array_merge(['_at', '_id', '_'], $replaces['key']);
        $replace_value = array_merge([' Date', '', ' '], $replaces['value']);
        foreach ($columns as $column) {
            if (! in_array($column, $exceptColumns)) {
                $result[$column] = (ucfirst(str_replace($replace_key, $replace_value, $column)));
            }
        }

        return $result;
    }

    public static function result(Builder $model, $records, $orderBy, $sortAs, $key, $byDate, $date1, $date2)
    {
        // dd($model);
        if ($byDate == 'within-day') {
            $model->whereDate('created_at', $date1);
        } elseif ($byDate == 'until-day') {
            $model->whereDate('created_at', '<=', $date1);
        } elseif ($byDate == 'range-date') {
            $model->whereDate('created_at', '>=', $date1)->whereDate('created_at', '<=', $date2);
        }
        if ($records == 'without-trashed') {
            return $model->search(trim($key))->orderBy($orderBy, $sortAs)->paginate(env('PAGINATION_COUNT'));
        } elseif ($records == 'trashed') {
            return $model->search(trim($key))->onlyTrashed()->orderBy($orderBy, $sortAs)->paginate(env('PAGINATION_COUNT'));
        } else {
            return $model->search(trim($key))->withTrashed()->orderBy($orderBy, $sortAs)->paginate(env('PAGINATION_COUNT'));
        }
    }
}
