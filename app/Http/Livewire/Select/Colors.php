<?php

namespace App\Http\Livewire\Select;

use App\Models\Color;
use App\Models\Vehicle;
use Livewire\Component;

class Colors extends Component
{
    public Color $color;
    public Vehicle $vehicle;

    protected $listeners = ['clear', 'set_vehicle'];

    public $search = "";
    public $multiple;
    public $colors;

    public function mount(Vehicle $vehicle)
    {
        $this->color = new Color;
        $this->vehicle = $vehicle;
        $this->multiple = 1;
        $this->colors = $this->vehicle->colors;
    }

    public function options()
    {
        return Color::where('name', 'LIKE', "%{$this->search}%")->get();
    }

    public function render()
    {
        return view('livewire.select.colors', [
            'options' => $this->options(),
        ]);
    }

    public function clear()
    {
        $this->color = new Color;
        $this->reset('search');
        $this->options();
        $this->colors = $this->vehicle->colors;
    }

    public function save()
    {
        $temporal = [];
        if ( $this->multiple ) {
            $temporal = explode(",", $this->search);
            $temporal = array_filter($temporal, 'strlen');
            $temporal = array_map('trim', $temporal);
        } else {
            array_push($temporal, trim($this->search));
        }
        foreach( $temporal as $key => $name ) {
            $color = Color::firstOrCreate(['name' => $name]);
            $this->search = "";
            $this->emitTo('vehicles.table', 'set_color', $color->id);
            $this->colors->push($color);
        }
        $this->color = new Color;
        $this->options();
    }

    public function set_color(int $id)
    {
        $color = Color::find($id);
        if ( $this->colors->contains($color) ) {
            return;
        }
        $this->colors->push($color);
        $this->emitTo('vehicles.table', 'set_color', $color->id);
        $this->search = "";
        $this->options();
    }

    public function remove_color(int $id)
    {
        $color = Color::find($id);
        if ( !$this->colors->contains($color) ) {
            return;
        }
        foreach ($this->colors as $key => $value) {
            if( $color == $value ) {
                unset($this->colors[$key]);
            }
        }
        $this->emitTo('vehicles.table', 'remove_color', $color->id);
        $this->search = "";
        $this->options();
    }

    // protected function rules()
    // {
    //     $rule_name_unique = "required|string|unique:colors,name";
    //     $rules = [
    //         'color.name' => $rule_name_unique,
    //     ];
    //     return $rules;
    // }

    // protected $messages = [
    //     'color.name.unique' => 'El color ya existe',
    // ];

    // listener
    public function set_vehicle(int $id)
    {
        $vehicle = Vehicle::find($id);
        $this->colors = $vehicle->colors;
    }
}
