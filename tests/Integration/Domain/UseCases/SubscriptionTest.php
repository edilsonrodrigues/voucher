<?php

declare(strict_types=1);

namespace Tests\Integration\Domain\UseCases;

use App\Domain\Exception\EqualPersonOriginException;
use App\Domain\UseCases\MakeRegistration\InputData as MakeRegistrationInputData;
use App\Domain\UseCases\MakeRegistration\MakeRegistration;
use App\Domain\UseCases\ApplyVoucher\ApplyVoucher;
use App\Domain\UseCases\ApplyVoucher\InputData;
use App\Infra\Repository\PaymentPlanRepositoryMemory;
use App\Infra\Repository\PersonRepositoryMemory;
use App\Infra\Repository\VoucherRepositoryMemory;
use DomainException;
use PHPUnit\Framework\TestCase;

interface SubscriptionRepository
{
    public function findById(int $id): Subscription;
}
final class Subscription
{
    public int $id;
    public int $personId;
}
class SubscriptionRepositoryMemory implements SubscriptionRepository
{
    public function findById(int $id): Subscription
    {
        $subscription = new Subscription;
        $subscription->id = 1;
        $subscription->personId = 1;
        return $subscription;
    }
}
final class InvalidVoucherException extends DomainException
{
    public static function personOriginEqualpersonRegistration(): self
    {
        return new self(
            'Esse Vouche nao pode ser usado por voce, voce e o master'
        );
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

        $this->assertEquals($output->status, 2);
    }

    public function testIfTheExceptionIsThrownWhenPersonOriginOfEqualSubscription()
    {
        $this->expectException(InvalidVoucherException::class);
        $voucherRepo = new VoucherRepositoryMemory();
        $subscriptionRepo = new SubscriptionRepositoryMemory();
        $useCase = new ApplyVoucher($voucherRepo, $subscriptionRepo);

        $inputData = new InputData();
        $inputData->voucherCode = 'DESCONTO';
        $inputData->subscriptionId = 1;
        $inputData->personOriginId = 1;
        $useCase->execute($inputData);
    }
}
