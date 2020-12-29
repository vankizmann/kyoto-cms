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

    protected function datatreeQuery($query)
    {
        $key = $query->getModel()->getLeftColumnName();

        $query->orderBy(
            Request::input('prop', $key), Request::input('dir', 'desc')
        );

        $total = $query->count();

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

        if ( $total === $query->count() ) {
            return $query;
        }

        $ids = [];

        foreach ( $query->get() as $item ) {
            $ids = array_merge($ids, $item->getAncestorsAndSelf()->pluck('id')->toArray());
        }

        return $query->orWhereIn('id', $ids);
    }

    public function scopeDatatree($query)
    {
        $query = $this->datatreeQuery($query);

        $data = $query->get()->toHierarchy()
            ->values()->toArray();

        return [
            'page' => 1, 'limit' => 0, 'total' => $query->count(), 'data' => $data
        ];
    }


}
