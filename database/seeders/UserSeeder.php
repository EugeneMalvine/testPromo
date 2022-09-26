<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create(
            [
                'name' => 'Eugene Malvine',
                'email' => 'test@example.com',
            ]
        );

        User::factory(10)->create();
    }
}
