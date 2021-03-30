<?php

namespace Database\Factories;

use App\Models\Form;
use App\Models\Guardian;
use App\Models\Applicant;
use App\Models\Signature;
use Illuminate\Database\Eloquent\Factories\Factory;

class FormFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Form::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $formable = [
            Applicant::class,
            Guardian::class
        ];

        $formableType = $this->faker->randomElement($formable);
        if ($formableType === Applicant::class) {
            $formableId = Applicant::all(['id'])->random();
        } else {
            $formableId = Guardian::all(['id'])->random();
        }

        return [
            'form_path' => $this->faker->image($dir = storage_path(), $width = 640, $height = 480),
            'formable_type' => $formableType,
            'formable_id' => $formableId,
        ];

        
    }

    public function applicant()
    {
        return $this->state(function (array $attributes) {
            return [
                'formable_type' => Applicant::class,
            ];
        });
    }

    public function guardian()
    {
        return $this->state(function (array $attributes) {
            return [
                'formable_type' => Guardian::class,
            ];
        });
    }
}
