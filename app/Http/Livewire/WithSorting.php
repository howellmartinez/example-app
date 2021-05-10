<?php

namespace App\Http\Livewire;

trait WithSorting
{
    public $sortField = 'name';
    public $sortAsc = true;

    public function mountWithSorting()
    {
        array_push($this->queryString, 'sortField', 'sortAsc');
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
