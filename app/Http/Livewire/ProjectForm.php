<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ProjectForm extends Component
{
    public $name;
    public $client;
    public $description;

    public $stages = [];

    protected $rules = [
        'name' => 'required',
        'client' => 'required',
        'description' => 'required',
    ];

    public function mounted()
    {
        $this->stages = collect([]);
    }

    public function addStage()
    {
        $stage = new \App\Models\Stage;
        array_push($this->stages, $stage);
    }

    public function create()
    {
        $this->validate();

        $project = \App\Models\Project::create([
            'name' => $this->name,
            'client' => $this->client,
            'description' => $this->description,
        ]);
       
        $project->stages()->createMany($this->stages);

        session()->flash('message', 'Project successfully updated.');

        return redirect()->to('/projects');
    }

    public function render()
    {
        return view('livewire.project-form');
    }
}
