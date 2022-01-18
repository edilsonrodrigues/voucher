<?php

declare(strict_types=1);

namespace Tests\Integration\Domain\UseCases;

use App\Domain\UseCases\MakeRegistration\InputData as MakeRegistrationInputData;
use App\Domain\UseCases\MakeRegistration\MakeRegistration;
use App\Domain\UseCases\ApplyVoucher\ApplyVoucher;
use App\Domain\UseCases\ApplyVoucher\InputData;
use App\Domain\UseCases\ApplyVoucher\OutputData;
use App\Infra\Repository\PaymentPlanRepositoryMemory;
use App\Infra\Repository\PersonRepositoryMemory;
use App\Infra\Repository\VoucherRepositoryMemory;
use PHPUnit\Framework\TestCase;
use stdClass;


interface SubscriptionRepository
{
    public function findById(int $id);
}

class SubscriptionRepositoryMemory implements SubscriptionRepository
{
    public function findById(int $id)
    {
        $std = new stdClass;
        $std->id = 1;
        $std->personId = 1;
    }
}




class SubscriptionTest extends TestCase
{
    public function testItShouldMakeSubscriptionWhenValidDataIsProvided()
    {
        $personRepo = new PersonRepositoryMemory();
        $paymentPlanRepo = new PaymentPlanRepositoryMemory();
        $useCase = new MakeRegistration($personRepo, $paymentPlanRepo);
        $inputData = new MakeRegistrationInputData;

        $inputData->personId = 1;
        $inputData->paymentPlanId = 123;

        $output = $useCase->execute($inputData);

        $this->assertEquals($output->personId, 1);
        $this->assertEquals($output->paymentPlanId, 123);
        $this->assertNotEmpty($output->id);
    }

    public function testItShouldApplyVoucherWhenItIsProvided()
    {
        $voucherRepo = new VoucherRepositoryMemory();
        $subscriptionRepo = new SubscriptionRepositoryMemory();
        $useCase = new ApplyVoucher($voucherRepo, $subscriptionRepo);

        $inputData = new InputData();
        $inputData->voucherCode = 'DESCONTO';
        $inputData->subscriptionId = 1;

        $output = $useCase->execute($inputData);

        $this->assertEquals($output->id, 1);
    }
}
