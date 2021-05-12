<?php

namespace App\Http\Livewire;

trait WithSorting
{
    public $sortField = 'id';
    public $sortAsc = true;
    public $query;

    public function mountWithSorting()
    {
        array_push($this->queryString, 'sortField', 'sortAsc');
    }

    public function getSortDirectionProperty()
    {
        return $this->sortAsc ? 'ASC' : 'DESC';
    }

    public function sortBy($field)
    {
        if ($this->sortField == $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }
}
