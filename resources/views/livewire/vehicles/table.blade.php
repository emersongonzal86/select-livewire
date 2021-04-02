<div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200" x-data="{open:false}">
                <div class="table-responsive" x-show="!open">
                    <div class="block">
                        <button wire:click="clear" type="button" class="border border-blue-600 text-blue-800 hover:bg-blue-600 hover:text-white py-1 px-2 mb-2 rounded-md text-sm font-semibold"
                            x-on:click="open = true">Nuevo Vehiculo</button>
                    </div>
                    <table class="table table-sm table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Marca</th>
                                <th>Colores</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($options as $item)
                                <tr>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->mark->name}}</td>
                                    <td>{{$item->colors->pluck('name')->implode(', ')}}</td>
                                    <td>
                                        <div class="flex">
                                            <button wire:click="set_vehicle({{$item->id}})" type="button" class="border border-green-600 text-green-800 hover:bg-green-600 hover:text-white py-1 px-2 mb-2 rounded-md text-sm font-semibold" x-on:click="open=true">Edit</button>
                                            <button type="button" class="border border-red-600 text-red-800 hover:bg-red-600 hover:text-white py-1 px-2 mb-2 rounded-md text-sm font-semibold">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td class="text-center" colspan="4">Sin vehiculos encontrados</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="" x-show="open" x-cloak>
                    <div class="flex">
                        <button wire:click="clear" type="button" class="border border-red-600 text-red-800 hover:bg-red-600 hover:text-white py-1 px-2 mb-2 rounded-md text-sm font-semibold mr-2" x-on:click="open = false">Cerrar</button>
                        @if (session()->has('success'))
                        <div class="bg-green-100 border-t border-b border-green-500 text-green-700 px-4 py-2" role="alert">
                            <p class="text-sm">{{ session('success') }}</p>
                        </div>
                    @endif
                    </div>
                    <div class="flex-col sm:flex sm:flex-row">
                        <div class="w-full sm:w-1/3 m-2">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                            <div class="my-1 relative rounded-md shadow-sm">
                                <input wire:model="vehicle.name" type="text" name="name" id="name" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2 sm:text-sm border-gray-300 rounded-md" placeholder="nombre">
                                @error('vehicle.name') <div class="block text-sm text-red-600">{{$message}}</div> @enderror
                                @error('vehicle.mark_id') <div class="block text-sm text-red-600">{{$message}}</div> @enderror
                                @error('colors') <div class="block text-sm text-red-600">{{$message}}</div> @enderror
                                @error('colors.*') <div class="block text-sm text-red-600">{{$message}}</div> @enderror
                            </div>
                        </div>
                        <div class="w-full sm:w-1/3 m-2">
                            <label for="name" class="block text-sm font-medium text-gray-700">Marcas</label>
                            {{-- Select Marcas --}}
                            @livewire('select.marks', ['vehicle' => $vehicle])
                        </div>
                        <div class="w-full sm:w-1/3 m-2">
                            <label for="name" class="block text-sm font-medium text-gray-700">Colores</label>
                            {{-- Select Colores --}}
                            @livewire('select.colors', ['vehicle' => $vehicle])
                        </div>
                    </div>
                    <div class="block w-1/3 m-2">
                        <button wire:click="save" type="button" class="border border-blue-600 text-blue-800 hover:bg-blue-600 hover:text-white py-1 px-2 mb-2 rounded-md text-sm font-semibold w-1/3">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
