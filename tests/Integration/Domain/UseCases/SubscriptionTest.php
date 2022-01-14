<?php

declare(strict_types=1);

namespace Tests\Integration\Domain\UseCases;

use App\Domain\Entity\PaymentPlan;
use App\Domain\Repository\PaymentPlanRepository;
use App\Domain\UseCases\MakeRegistration\InputData;
use App\Domain\UseCases\MakeRegistration\MakeRegistration;
use App\Infra\Repository\PaymentPlanRepositoryMemory;
use App\Infra\Repository\PersonRepositoryMemory;
use PHPUnit\Framework\TestCase;

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
        $this->assertEquals($output->paymentPlanId, 123);
        $this->assertNotEmpty($output->id);
    }

    //  public function testItShouldApplyVoucherWhenItIsProvided()
    // {
    //    $codeVoucher = '12312312312312321';
    // }
}
