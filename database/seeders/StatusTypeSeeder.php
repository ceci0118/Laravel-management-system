<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Guardian;
use App\Models\Applicant;
use App\Models\MailMessage;
use App\Models\MailTemplate;
use App\Models\StatusType;
use Illuminate\Database\Seeder;

class StatusTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        # 1=Created, 2=Notified, 3=In Progress, 4 = Complete
        StatusType::create([
            'id' => 1,
            'type' => 'created'
        ]);

        StatusType::create([
            'id' => 2,
            'type' => 'notified'
        ]);

        StatusType::create([
            'id' => 3,
            'type' => 'in progress'
        ]);

        StatusType::create([
            'id' => 4,
            'type' => 'complete'
        ]);


        
        // My testing seeder
        // Applicant::factory()->player()->created()->count(10)->create();
        // Guardian::factory(4)->create();

        // Applicant::find(1)->guardians()->attach(1);
        // Applicant::find(1)->guardians()->attach(2);
        // Applicant::find(2)->guardians()->attach(3);
        // Applicant::find(2)->guardians()->attach(4);

        // User::factory()->create();
        // MailTemplate::factory()->create();
        // MailMessage::factory()->create();
    }
}
