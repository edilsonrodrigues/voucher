<?php

declare(strict_types=1);

namespace Tests\Integration\Domain\UseCases;

use App\Domain\UseCases\MakeRegistration\InputData;
use App\Domain\UseCases\MakeRegistration\MakeRegistration;
use App\Infra\Repository\PersonRepositoryMemory;
use PHPUnit\Framework\TestCase;

class PaymentPlan
{
    public int $id;
    public int $professionalCategoryId;
}
interface PaymentPlanRepository
{
    public function findById(int $id): PaymentPlan;
}

class PaymentPlanRepositoryMemory  implements PaymentPlanRepository
{
    public function findById(int $id): PaymentPlan
    {
        $paymentPlan = new PaymentPlan();
        $paymentPlan->id = 1;
        $paymentPlan->professionalCategoryId = 1;
        return $paymentPlan;
    }
}
class SubscriptionTest extends TestCase
{
    public function testItShouldMakeSubscriptionWhenValidDataIsProvided()
    {
        $personRepo = new PersonRepositoryMemory();
        $PaymentPlanRepo = new PaymentPlanRepositoryMemory();
        $useCase = new MakeRegistration($personRepo, $PaymentPlanRepo);
        $inputData = new InputData;

        $inputData->personId = 1;
        $inputData->paymentPlanId = 123;

        $output = $useCase->execute($inputData);

        $this->assertEquals($output->personId, 1);
        $this->assertNotEmpty($output->id);
    }
}
