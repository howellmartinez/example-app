<?php

namespace App\Http\Livewire;

use Livewire\Component;

class StageForm extends Component
{
    public $stage;

    protected $rules = [
        'description' => 'required',
    ];

    public function render()
    {
        return view('livewire.stage-form');
    }
}
