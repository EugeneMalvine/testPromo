<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\PromocodeEnum;
use App\Models\Promocode;
use Illuminate\Database\Seeder;

class PromocodeSeeder extends Seeder
{
    private const MAX_ITEMS = 10000;

    public function run(): void
    {
        if (PromocodeEnum::GENERATE_COUNT === 0) {
            return;
        }

        Promocode::truncate();

        $iterations = (int) ceil(PromocodeEnum::GENERATE_COUNT / self::MAX_ITEMS);
        $remainder = PromocodeEnum::GENERATE_COUNT % self::MAX_ITEMS;


        do {
            $iterations--;

            $promo = Promocode::factory($iterations === 0 && $remainder !== 0 ? $remainder : self::MAX_ITEMS)->make();

            Promocode::query()->insert($promo->toArray());
        } while ($iterations > 0);
    }
}
