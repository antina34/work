<?php

use App\Models\BoUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class BoUserSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        BoUser::updateOrCreate(
            ['email' => 'admin@mybitcoin.ai'],
            ['name' => 'Back-office Admin', 'password' => Hash::make('adm1nadm1n')]
        );
    }
}
