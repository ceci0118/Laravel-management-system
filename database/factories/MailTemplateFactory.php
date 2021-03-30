<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\MailTemplate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\Factory;

class MailTemplateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MailTemplate::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user_id = User::all(['id'])->random();
        $faker = \Faker\Factory::create();
        return [
            'title' => $this->faker->text($maxNbChars = 20),
            'body' => $this->faker->text($maxNbChars = 200),
            'user_id' => User::all(['id'])->random(),
        ];
    }
}
