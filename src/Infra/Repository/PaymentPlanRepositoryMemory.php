<?php

namespace App\Infra\Repository;

use App\Domain\Entity\Activity;
use App\Domain\Entity\PaymentPlan;
use App\Domain\Entity\ProfessionalCategory;
use App\Domain\Repository\PaymentPlanRepository;

class PaymentPlanRepositoryMemory  implements PaymentPlanRepository
{
    public function findById(int $id): PaymentPlan
    {
        $paymentPlan = new PaymentPlan();
        $professionalCategory = new ProfessionalCategory();
        $activity = new Activity();

        $activity->id = 1;
        $activity->name = 'Curso';

        $professionalCategory->id = 1;
        $professionalCategory->name = 'Medico';

        $paymentPlan->id = 123;
        $paymentPlan->professionalCategory = $professionalCategory;
        $paymentPlan->activity =  $activity;
        $paymentPlan->price = 100;

        return $paymentPlan;
    }
}
