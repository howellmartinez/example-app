<?php

namespace App\Model\Traits;

trait CanFilterBy
{
    protected function getFilters()
    {
        return $this->filters ?? [];
    }

    public function scopeFilter($query, $value, $operator = '=')
    {
        foreach ($this->getFilters() as $index => $filter) {
            if ($index == 0) {
                $query->filterBy($filter, $value, $operator);
            } else {
                $query->orWhere(function ($query) use ($filter, $value, $operator) {
                    $query->filterBy($filter, $value, $operator);
                });
            }
        }
        return $query;
    }

    public function scopeFilterBy($query, $key, $value, $operator = '=')
    {
        $scopeMethod = \Str::camel('scope' . ucfirst($key));
        
        if (method_exists($query->getModel(), $scopeMethod)) {
            $scope = \Str::camel($key);
            return $query->$scope($value, $operator);
        }

        $key = \Str::snake($key);

        if (strtoupper($value) == 'NULL') {
            if ($operator == '=') {
                return $query->whereNull($key);
            }
            if ($operator == '!=' || $operator == '<>') {
                return $query->whereNotNull($key);
            }
        }
        
        if (strtoupper($value) == 'TRUE') {
            $value = true;
        } elseif (strtoupper($value) == 'FALSE') {
            $value = false;
        }
        
        return $query->where($key, $operator, $value);
    }
}
