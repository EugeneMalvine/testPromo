<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\PromocodeEnum;
use App\Models\Promocode;
use App\Models\User;
use DateTime;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class PromocodeService
{
    public static function generateShuffleCode(int $length = PromocodeEnum::MAX_LENGTH): string
    {
        $range = array_merge(range('a', 'z'), range(0, 9));
        $limitRange = count($range) - 1;
        $shuffleCode = '';

        for ($i = 0; $i < $length; $i++) {
            $shuffleCode .= $range[random_int(0, $limitRange)];
        }

        return $shuffleCode;
    }

    public function getPromocode(?User $user): ?string
    {
        if ($user === null) {
            return null;
        }

        $promocode = $user->promocode ?? $this->issuePromocodeToUser($user) ?? $this->createUserPromocode($user);

        return $promocode?->code;
    }

    private function issuePromocodeToUser(User $user): Builder | Model | Promocode | null
    {
        $promocode = Promocode::query()->whereNull('user_id')->first();

        if ($promocode === null) {
            return null;
        }

        $promocode->update([
            'user_id' => $user->id,
            'activated_at' => new DateTime(),
        ]);

        return $promocode;
    }

    private function createUserPromocode(User $user): Builder | Model | Promocode
    {
        return Promocode::query()->create([
            'code' => self::generateShuffleCode(),
            'user_id' => $user->id,
            'activated_at' => new DateTime(),
        ]);
    }
}
