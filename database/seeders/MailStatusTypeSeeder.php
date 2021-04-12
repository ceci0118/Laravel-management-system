<?php

namespace Database\Seeders;

use App\Models\MailStatusType;
use Illuminate\Database\Seeder;

class MailStatusTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        # 1 - Sent, 2 - Opened, 3 - Bounced
        MailStatusType::create([
            'id' => 1,
            'type' => 'sent'
        ]);

        MailStatusType::create([
            'id' => 2,
            'type' => 'opend'
        ]);

        MailStatusType::create([
            'id' => 3,
            'type' => 'bounced'
        ]);
    }
}
