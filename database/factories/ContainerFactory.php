<?php

namespace Database\Factories;

use App\Models\Container;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContainerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Container::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'container_number' => $this->faker->text(10),
            'booking_number' => $this->faker->text(10),
            'shipping_line' => $this->faker->text(10),
            'port' => $this->faker->city,
            'destination' => $this->faker->countryCode,
            'capacity' => $this->faker->numberBetween(1, 4),
            'paid' => $this->faker->boolean,
            'tracking_link' => $this->faker->url,
            'departure_date' => $this->faker->date(),
            'arrival_date' => $this->faker->date(),
            'container_status_id' => $this->faker->numberBetween(1, 2)
        ];
    }
}
