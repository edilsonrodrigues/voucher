<?php

namespace App\Infra\Repository;

use App\Domain\Entity\PaymentPlan;
use App\Domain\Repository\PaymentPlanRepository;

class PaymentPlanRepositoryMemory  implements PaymentPlanRepository
{
    public function findById(int $id): PaymentPlan
    {
        $paymentPlan = new PaymentPlan();
        $paymentPlan->id = 123;
        $paymentPlan->professionalCategoryId = 1;
        return $paymentPlan;
    }
}
