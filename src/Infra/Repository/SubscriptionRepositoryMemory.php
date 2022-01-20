<?php

namespace App\Infra\Repository;

use App\Domain\Entity\Subscription;
use App\Domain\Repository\SubscriptionRepository;

class SubscriptionRepositoryMemory implements SubscriptionRepository
{
    private array $storage = [];

    public function findById(int $id): Subscription
    {
        $subscription = new Subscription;
        $subscription->id = 1;
        $subscription->personId = 1;
        $subscription->price = 100;
        return $subscription;
    }

    public function subscribe(Subscription $subscription): int
    {
        $id = count($this->storage) + 1;
        $record = [
            'id' => $id,
            'pessoa_id' => $subscription->person->id,
            'status' => $subscription->status,
            'data_inscricao' => $subscription->createdAt->format('Y-m-d'),
            'criado_em' => $subscription->createdAt->format('Y-m-d H:i:s'),
        ];
        $subscription->id = $id;

        $this->storage[] = $record;

        return $id;
    }
}
