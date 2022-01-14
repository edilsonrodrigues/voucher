<?php

namespace App\Domain\Repository;

use App\Domain\Entity\PaymentPlan;

interface PaymentPlanRepository
{
    public function findById(int $id): PaymentPlan;
}
