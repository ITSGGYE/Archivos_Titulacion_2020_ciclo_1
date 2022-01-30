<?php

namespace Database\Factories;

use App\Models\Representante;
use Illuminate\Database\Eloquent\Factories\Factory;

class RepresentanteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Representante::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return[
            'cedula' => $this->faker->unique()->uuid,
            'nombre' => $this->faker->firstName,
            'apellido' => $this->faker->lastName,
            'telefono' => $this->faker->phoneNumber,
            'direccion' => $this->faker->streetAddress,
            'correo' => $this->faker->unique()->safeEmail,

        ];
    }
}
