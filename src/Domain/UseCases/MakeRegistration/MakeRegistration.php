<?php

namespace App\Domain\UseCases\MakeRegistration;

use App\Domain\Repository\PersonRepository;
use Tests\Integration\Domain\UseCases\PaymentPlanRepository;

class MakeRegistration
{
    public function __construct(private PersonRepository $personRepo, private PaymentPlanRepository $paymentPlanRepo)
    {
    }

    public function execute(InputData $inputData): OutputData
    {
        $person = $this->personRepo->findById($inputData->personId);
        $paymentPlan = $this->paymentPlanRepo->findById($inputData->paymentPlanId);
        $outputData = new OutputData;
        $outputData->id = 1;
        $outputData->personId = $person->id;
        $outputData->paymentPlanId = $paymentPlan->id;

        return $outputData;
    }
}
