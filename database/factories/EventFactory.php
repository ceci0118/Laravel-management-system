<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Guardian;
use App\Models\Applicant;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        /*
            TO RUN:
            Launch artistan tinker then run
            \App\Models\Event::factory()->count(9)->create();
        */
        $guardian_id = Guardian::all(['id'])->random();
        $applicant_id = Applicant::all(['id'])->random();
        $faker = \Faker\Factory::create();
        return [
            //
            'type' =>$faker-> unique() -> randomDigitNot(0),
            'applicant_id' => $applicant_id,
            'guardian_id' => $guardian_id,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()

        ];
    }
}
