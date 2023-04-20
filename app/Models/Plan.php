<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Plan extends Model
{
    use HasFactory;

    public static function findByStripePriceId($stripePlanId): Plan
    {
        return self::where('stripe_monthly_price_id', $stripePlanId)
            ->orWhere('stripe_yearly_price_id', $stripePlanId)
            ->first();
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

}
