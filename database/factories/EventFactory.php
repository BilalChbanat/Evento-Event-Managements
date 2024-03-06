<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = \Faker\Factory::create();

        return [
            'title' => $faker->sentence(4),
            'location' => $faker->city,
            'capacity' => $faker->numberBetween(50, 500),
            'availableSeats' => $faker->numberBetween(1, 50),
            'image' => $this->faker->optional()->imageUrl(),
            'price' => $faker->randomFloat(2, 10, 100),
            'acceptance' => $faker->randomElement(['auto', 'manual']),
            'status' => $faker->randomElement(['pending', 'accepted', 'rejected']),
            'description' => $faker->paragraph(4),
            'date' => $faker->dateTimeBetween('+1 week', '+3 months'),
            'user_id' => \App\Models\User::factory(),
            'category_id' => \App\Models\Category::factory(),
        ];
    }
}
