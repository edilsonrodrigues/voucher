<?php

namespace App\Domain\UseCases\MakeRegistration;

use App\Domain\Entity\Subscription;
use App\Domain\Exception\InvalidPaymentPlanException;
use App\Domain\Exception\InvalidSubscriptionException;
use App\Domain\Repository\PaymentPlanRepository;
use App\Domain\Repository\PersonRepository;
use App\Domain\Repository\SubscriptionRepository;
use DateTimeImmutable;

class MakeRegistration
{
    public function __construct(
        private PersonRepository $personRepo,
        private PaymentPlanRepository $paymentPlanRepo,
        private SubscriptionRepository $subscriptionRepo
    ) {
    }

    public function execute(InputData $inputData): OutputData
    {
        $person = $this->personRepo->findById($inputData->personId);

        if (!$person) {
            throw InvalidSubscriptionException::personIsNotValid();
        }

        $paymentPlan = $this->paymentPlanRepo->findById($inputData->paymentPlanId);

        if (!$paymentPlan) {
            throw InvalidPaymentPlanException::paymentPlanIsNotValid();
        }

        $subscription = new Subscription();
        $subscription->person = $person;
        $subscription->markAsPending(new DateTimeImmutable($inputData->createdAt));

        $this->subscriptionRepo->subscribe($subscription);

        $outputData = new OutputData;
        $outputData->id = $subscription->id;
        $outputData->personId = $person->id;
        $outputData->paymentPlanId = $paymentPlan->id;
        $outputData->price = $paymentPlan->price;
        $outputData->status = $subscription->status;
        $outputData->createdAt = $subscription->createdAt->format('Y-m-d H:i:s');

        return $outputData;
    }
}
