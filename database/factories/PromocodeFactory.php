<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Services\PromocodeService;
use Illuminate\Database\Eloquent\Factories\Factory;

class PromocodeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'code' => PromocodeService::generateShuffleCode(),
        ];
    }
}
