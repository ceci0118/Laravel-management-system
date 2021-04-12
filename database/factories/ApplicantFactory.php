<?php

namespace Database\Factories;

use App\Models\Applicant;
use App\Models\Form;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApplicantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Applicant::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first' => $this->faker->firstName,
            'last' => $this->faker->lastName,
            'dob' => $this->faker->date,
            'email' => $this->faker->unique()->safeEmail,
            'applicant_type' => $this->faker->numberBetween($min = 1, $max = 4), # 1=players,  2=coach, 3=officials, 4=trainers
            'applicant_id' => $this->faker->unique()->randomNumber($nbDigits = 6),
            'season_id' => 1,
            'status' => $this->faker->numberBetween($min = 1, $max = 4), # 1=Created, 2=Notified, 3=In Progress, 4 = Complete
        ];
    }

    public function player()
    {
        return $this->state(function (array $attributes) {
            return [
                'applicant_type' => '1',
            ];
        });
    }

    public function coach()
    {
        return $this->state(function (array $attributes) {
            return [
                'applicant_type' => '2',
            ];
        });
    }

    public function official()
    {
        return $this->state(function (array $attributes) {
            return [
                'applicant_type' => '3',
            ];
        });
    }

    public function trainer()
    {
        return $this->state(function (array $attributes) {
            return [
                'applicant_type' => '4',
            ];
        });
    }

    public function created()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => '1',
            ];
        });
    }


    public function notified()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => '2',
            ];
        });
    }

    public function inprogress()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => '3',
            ];
        });
    }

    public function complete()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => '4',
            ];
        });
    }
}

/* TO RUN ALL FACTORIES (MUST RUN IN ORDER):
            \App\Models\User::factory()->count(5)->create(); 
            \App\Models\Form::factory()->count(5)->create();
            \App\Models\Applicant::factory()->count(100)->create();
            \App\Models\Guardian::factory()->count(150)->create();
            \App\Models\Event::factory()->count(9)->create();
            \App\Models\MailTemplate::factory()->count(3)->create();
            \App\Models\MailMessage::factory()->count(150)->create();
            \App\Models\Signature::factory()->count(100)->create();









*/