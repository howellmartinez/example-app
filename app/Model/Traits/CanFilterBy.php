<?php

namespace App\Model\Traits;

trait CanFilterBy
{
    protected function getSearchables()
    {
        return $this->searchable ?? [];
    }

    public function scopeSearch($query, $value, $operator = '=')
    {
        foreach ($this->getSearchables() as $index => $searchable) {
            if ($index == 0) {
                $query->filterBy($searchable, $value, $operator);
            } else {
                $query->orWhere(function ($query) use ($searchable, $value, $operator) {
                    $query->filterBy($searchable, $value, $operator);
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
