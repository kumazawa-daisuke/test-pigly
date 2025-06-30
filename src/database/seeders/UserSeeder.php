<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\WeightLog;
use App\Models\WeightTarget;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'テスト太郎',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
        ]);

        WeightLog::factory()
            ->count(35)
            ->for($user)
            ->create();

        WeightTarget::factory()
            ->for($user)
            ->create();
    }
}
