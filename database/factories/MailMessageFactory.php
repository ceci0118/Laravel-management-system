<?php

namespace Database\Factories;

use App\Models\Applicant;
use App\Models\MailMessage;
use App\Models\MailStatusType;
use App\Models\MailTemplate;
use Illuminate\Database\Eloquent\Factories\Factory;

class MailMessageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MailMessage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $applicant = Applicant::all()->random();

        return [
            'applicant_id' => $applicant->id,
            'mail_template_id' => MailTemplate::all(['id'])->random(),
            'subject' => $this->faker->text($maxNbChars = 10),
            'from' => $this->faker->safeEmail,
            'to' => $applicant->email,
            'content' => $this->faker->text($maxNbChars = 200),
            'mail_status' => MailStatusType::find(1)->id
        ];
    }
}


// MailMessage::create([
//     'applicant_id' => 1,
//     'mail_template_id' => 1,
//     'subject' => 'Subject test',
//     'from' => 'test@test.com',
//     'to' => Applicant::find(1)->email,
//     'content' => 'content',
//     'mail_status' => 1
// ])