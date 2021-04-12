<?php

namespace Database\Factories;

use App\Models\Signature;
use Illuminate\Database\Eloquent\Factories\Factory;

class SignatureFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Signature::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'signature_path' => $this->faker->image($dir = storage_path(), $width = 640, $height = 480),
        ];
    }
}
