<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\PromocodeEnum;
use App\Services\PromocodeService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class PromoController extends BaseController
{
    public function __construct(private PromocodeService $promocodeService)
    {
    }

    public function getPromo(): RedirectResponse
    {
        $code = $this->promocodeService->getPromocode(Auth::user());

        if ($code === null) {
            return back();
        }

        return redirect()->away(sprintf(PromocodeEnum::PROMO_LINK, $code));
    }
}
