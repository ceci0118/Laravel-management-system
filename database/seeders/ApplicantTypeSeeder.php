<?php

namespace Database\Seeders;

use App\Models\ApplicantType;
use Illuminate\Database\Seeder;

class ApplicantTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ApplicantType::create([
            'id' => 1,
            'type' => 'player'
        ]);

        ApplicantType::create([
            'id' => 2,
            'type' => 'coach'
        ]);

        ApplicantType::create([
            'id' => 3,
            'type' => 'official'
        ]);

        ApplicantType::create([
            'id' => 4,
            'type' => 'trainer'
        ]);

    }
}

// Applicant::create([
//     'first' => 'John',
//     'last' => 'Doe',
//     'dob' => '2000-01-01',
//     'email' => 'test@test.com',
//     'applicant_type' => 1,
//     'applicant_id' => null,
//     'season_id' => 1,
// ])