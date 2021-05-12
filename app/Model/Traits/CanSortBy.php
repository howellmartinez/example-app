<?php

namespace App\Model\Traits;

trait CanSortBy
{
    public function scopeSortBy($query, $key, $direction = 'ASC')
    {
        $scopeMethod = \Str::camel('scopeSortBy' . ucfirst($key));

        if (method_exists($query->getModel(), $scopeMethod)) {
            $scope = \Str::camel('sortBy' . ucfirst($key));
            return $query->$scope($direction);
        }
        
        $key = \Str::snake($key);
        
        return $query->orderBy($key, $direction);
    }
}
