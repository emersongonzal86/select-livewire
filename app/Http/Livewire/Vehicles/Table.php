<?php

namespace App\Http\Livewire\Vehicles;

use App\Models\Vehicle;
use Livewire\Component;

class Table extends Component
{
    public Vehicle $vehicle;
    public $colors = [];

    protected $listeners = [
        'set_mark',
        'set_color',
        'remove_color',
    ];

    public function mount()
    {
        $this->vehicle = new Vehicle;
    }

    public function getOptionsProperty()
    {
        return Vehicle::latest()->get();
    }

    public function render()
    {
        return view('livewire.vehicles.table', [
            'options' => $this->options,
        ]);
    }

    public function clear()
    {
        $this->vehicle = new Vehicle;
        $this->emit('clear');
    }

    public function save()
    {
        $this->validate();
        $this->vehicle->save();
        if ( count($this->colors) ) {
            $this->vehicle->colors()->sync($this->colors);
        }
        $this->vehicle = new Vehicle;
        session()->flash('success', 'Vehicle successfully updated.');
        $this->emit('clear');
    }

    public function set_vehicle(int $id)
    {
        $this->vehicle = Vehicle::find($id);
        $this->colors = $this->vehicle->colors->pluck('id')->toArray();
        $this->emit('set_vehicle', $id);
    }

    protected function rules()
    {
        $rule_name_unique = (!$this->vehicle->id) ? "required|string|unique:vehicles,name" : "required|string|unique:vehicles,name,{$this->vehicle->id}";
        $rules = [
            'vehicle.name' => $rule_name_unique,
            'vehicle.mark_id' => 'required|integer|exists:marks,id',
            'colors' => 'nullable|array',
            'colors.*' => 'required|integer|exists:colors,id',
        ];
        return $rules;
    }

    protected $messages = [
        'vehicle.name.unique' => 'El vehiculo ya existe',
    ];

    // Listener
    public function set_mark(int $mark_id)
    {
        $this->vehicle->mark_id = $mark_id;
    }

    // listener
    public function set_color(int $id)
    {
        $this->colors[] = $id;
    }

    // listener
    public function remove_color(int $id)
    {
        if ( !in_array($id, $this->colors)) {
            return;
        }
        if (($key = array_search($id, $this->colors)) !== false) {
            unset($this->colors[$key]);
        }
    }
}
