<?php

namespace Kyoto\Support\Database\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Request;

trait Datatable
{

    protected function datatableQuery($query)
    {
        $key = $query->getModel()->getKeyName();

        $query->orderBy(
            Request::input('prop', $key), Request::input('dir', 'desc')
        );

        $search = [
            'search' => Request::input('search', ''),
            'columns' => Request::input('columns', [$key]),
        ];

        if ( ! empty($search['search']) ) {
            $query->where(function ($query) use ($search) {
                foreach ( $search['columns'] as $column ) {
                    $query->orWhere($column, 'LIKE', '%' . $search['search'] . '%');
                }
            });
        }

        foreach ( Request::input('filter', []) as $key => $filter ) {

            $operator = '=';

            if ( $filter['operator'] === 'eq' ) {
                $operator = '=';
            }

            if ( $filter['operator'] === 'ne' ) {
                $operator = '!=';
            }

            if ( $filter['operator'] === 'li' ) {
                $operator = 'LIKE';
            }

            if ( $filter['operator'] === 'nl' ) {
                $operator = 'NOT LIKE';
            }

            if ( $filter['operator'] === 'in' ) {
                $operator = '=';
            }

            if ( $filter['operator'] === 'ni' ) {
                $operator = '!=';
            }

            if ( $filter['operator'] === 'lt' ) {
                $operator = '<=';
            }

            if ( $filter['operator'] === 'gt' ) {
                $operator = '>=';
            }

            $value = $filter['value'];

            if ( $filter['operator'] === 'li' ) {
                $value = '%' . $filter['value'] . '%';
            }

            if ( $filter['operator'] === 'nl' ) {
                $value = '%' . $filter['value'] . '%';
            }

            if ( $filter['type'] === 'option' ) {
                $value = explode(',', $filter['value']);
            }

            if ( $filter['type'] === 'datetime' ) {
                $value = Carbon::make($filter['value'])->format('Y-m-d');
            }

            $query->where(function ($query) use ($filter, $value, $operator) {

                foreach ( (array) $value as $key => $option ) {

                    $method = ! $key ? 'where' : 'orWhere';

                    if ( $filter['type']  === 'option' ) {
                        $method = ! $key ? 'whereIn' : 'orWhereIn';
                    }

                    if ( $filter['type']  === 'datetime' ) {
                        $method = ! $key ? 'whereDate' : 'orWhereDate';
                    }

                    $query->{$method}($filter['property'], $operator, $option);
                }

            });

        }

        return $query;
    }

    public function scopeDatatable($query)
    {
        $query = $this->datatableQuery($query);

        $page = (int) Request::input('page', 1);
        $limit = (int) Request::input('limit', 25);

        if ( $page > ceil(($total = $query->count()) / $limit) ) {
            $page = 1;
        }

        $data = $query->offset(($page - 1) * $limit)->limit($limit)->get();

        return [
            'page' => $page, 'limit' => $limit, 'total' => $total, 'data' => $data
        ];
    }

    public function scopeDatatree($query)
    {
        $query = $this->datatableQuery($query);

        $total = $query->count();

        $data = $query->get()->toHierarchy()->values();

        return [
            'page' => 1, 'limit' => 0, 'total' => $total, 'data' => $data
        ];
    }


}
