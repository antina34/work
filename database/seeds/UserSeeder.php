<?php

use App\Models\Invoice;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['name' => 'Anastasia Anastasia'],
            ['email' => Str::random(10) . '@gmail.com', 'password' => '$2y$10$aBS4eHLcy3eYcc0WcednceO8dfWvS6ojkqheN7dhzQr2iMG/kcUs2']
        );
        User::updateOrCreate(
            ['name' => 'First Last'],
            [
                'email' => 'user@mybitcoin.ai',
                'email_verified_at' => date(Invoice::DATE_TIME_FORMAT),
                'password' => Hash::make('us3rus3r')
            ]
        );
    }
}
