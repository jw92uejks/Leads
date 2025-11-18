<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Subscription;

class SubscriptionRepository extends AbstractRepository
{
    protected static $model = Subscription::class;
}
