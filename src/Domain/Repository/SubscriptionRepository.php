<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Subscription;

interface SubscriptionRepository
{
    public function findById(int $id): Subscription;
    public function subscribe(Subscription $subscription): int;
}
