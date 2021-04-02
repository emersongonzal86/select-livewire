## Select Livewire

Prueba de un campo de selección, tanto simple como multiple, usando livewire
Permite la creación de atributos o propiedades mediante un input.

En este repositorio se ve el funcionamiento de un CRUD de vehiculos, que llevan un nombre, una marca y registra los colores.
Un vehiculo solo tiene una marca, pero puede tener muchos colores
Un color puede estar en varios vehiculos

Asi la tabla `vehicles`, sus campos seran `name`, `mark`, `color_id`
Asi la tabla `marks` con un único campo `name`
Asi la tabla `colors` con un único campo `name`

## Instalar Livewire
- `composer require livewire/livewire`

## Instalar Tailwind Tables
- plugin que simula las clases de bootstrap para las tablas html - [link](https://github.com/drehimself/tailwindcss-tables)
- `npm install tailwindcss-tables --save`

## Crear los modelos y migraciones
- `php artisan make:model Mark -msf`
- `php artisan make:model Color -msf`
- `php artisan make:model Vehicle -msf`
- `php artisan make:migration create_color_vehicle_table`

*por ahora no necesitaremos los factories ni los seeder, pero siempre es bueno tenerlos a mano*

Completar las migraciones y los modelos
`php artsan migrate`