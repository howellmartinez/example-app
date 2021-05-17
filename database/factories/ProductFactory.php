<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $unitPrice =random_int(1, 100); 
        return [
            'name' => $this->faker->name,
            'unit_price' => $unitPrice,
            'unit_cost' => $unitPrice * .9,
        ];
    }
}
