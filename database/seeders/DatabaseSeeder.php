<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\ApplicantTypeSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ApplicantTypeSeeder::class);
        $this->call(MailStatusTypeSeeder::class);
        $this->call(StatusTypeSeeder::class);
    }
}
