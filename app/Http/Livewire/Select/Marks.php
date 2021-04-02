<?php

namespace App\Http\Livewire\Select;

use App\Models\Mark;
use App\Models\Vehicle;
use Livewire\Component;

class Marks extends Component
{
    public Mark $mark;
    public Vehicle $vehicle;

    protected $listeners = ['clear', 'set_vehicle'];

    public $search = "";
    public $multiple;

    public function mount(Vehicle $vehicle)
    {
        $this->mark = new Mark;
        $this->vehicle = $vehicle;
        $this->multiple = 0;
    }

    public function options()
    {
        return Mark::where('name', 'LIKE', "%{$this->search}%")->get();
    }

    public function render()
    {
        return view('livewire.select.marks', [
            'options' => $this->options(),
        ]);
    }

    public function clear()
    {
        $this->mark = new Mark;
        $this->reset('search');
        $this->options();
    }

    public function save()
    {
        $this->mark = Mark::firstOrCreate(['name' => $this->search]);
        $this->emitTo('vehicles.table', 'set_mark', $this->mark->id);
        $this->search = "";
        $this->options();
    }

    public function set_mark(int $id)
    {
        $this->mark = Mark::find($id);
        $this->emitTo('vehicles.table', 'set_mark', $this->mark->id);
    }

    // protected function rules()
    // {
    //     $rule_name_unique = "required|string|unique:marks,name";
    //     $rules = [
    //         'mark.name' => $rule_name_unique,
    //     ];
    //     return $rules;
    // }

    // protected $messages = [
    //     'mark.name.unique' => 'La marca ya existe',
    // ];

    // listener
    public function set_vehicle(int $id)
    {
        $vehicle = Vehicle::find($id);
        $this->mark = $vehicle->mark;
    }
}
