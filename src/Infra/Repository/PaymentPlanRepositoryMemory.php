<?php

namespace App\Infra\Repository;

use App\Domain\Entity\Activity;
use App\Domain\Entity\ActivitySchedule;
use App\Domain\Entity\PaymentPlan;
use App\Domain\Entity\ProfessionalCategory;
use App\Domain\Repository\PaymentPlanRepository;

class PaymentPlanRepositoryMemory  implements PaymentPlanRepository
{

    public function __construct(private array $storage = [])
    {
        $paymentPlan = new PaymentPlan();
        $professionalCategory = new ProfessionalCategory();
        $activity = new Activity();

        $activity->id = 1;
        $activity->description = 'Curso';

        $activitySchedule = new ActivitySchedule();
        $activitySchedule->id = 1;
        $activitySchedule->description = 'Curso primeiro horario';
        $activitySchedule->activity = $activity;

        $professionalCategory->id = 1;
        $professionalCategory->description = 'Medico';

        $paymentPlan->id = 123;
        $paymentPlan->professionalCategory = $professionalCategory;
        $paymentPlan->activitySchedule =  $activitySchedule;
        $paymentPlan->price = 100;

        $this->storage[] = $paymentPlan;
    }

    public function findById(int $id): ?PaymentPlan
    {
        $paymentPlan = array_filter(
            $this->storage,
            function ($paymentPlan) use ($id) {
                return $paymentPlan->id == $id;
            }
        );
        return count($paymentPlan) ? current($paymentPlan) : null;
    }
}
