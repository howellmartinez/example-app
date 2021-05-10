<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Counter extends Component
{
    public $myCounter = 0;

    public function increment()
    {
        $this->myCounter++;
    }

    public function decrement()
    {
        $this->myCounter--;
    }

    public function render()
    {
        return view('livewire.counter');
    }
}
