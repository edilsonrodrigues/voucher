<?php

declare(strict_types=1);

namespace Tests\Integration\Domain\UseCases;

use App\Domain\Exception\InvalidPaymentPlanException;
use App\Domain\Exception\InvalidSubscriptionException;
use App\Domain\Exception\InvalidVoucherException;
use App\Domain\UseCases\ApplyVoucher\ApplyVoucher;
use App\Domain\UseCases\ApplyVoucher\InputData;
use App\Domain\UseCases\MakeRegistration\InputData as MakeRegistrationInputData;
use App\Domain\UseCases\MakeRegistration\MakeRegistration;
use App\Infra\Repository\PaymentPlanRepositoryMemory;
use App\Infra\Repository\PersonRepositoryMemory;
use App\Infra\Repository\SubscriptionRepositoryMemory;
use App\Infra\Repository\VoucherRepositoryMemory;
use PHPUnit\Framework\TestCase;

class SubscriptionTest extends TestCase
{
    public function testItShouldMakeSubscriptionWhenValidDataIsProvided()
    {
        //atividade - plano de pagaemnto - titulo
        //plano de pagamento - categoria - valor
        //categoria - nome
        //pessoa - nome, email,cpf
        //inscricao - plano pagamento, pessoa, numero inscricao
        $personRepo = new PersonRepositoryMemory();
        $paymentPlanRepo = new PaymentPlanRepositoryMemory();
        $subscriptionRepo = new SubscriptionRepositoryMemory();
        $useCase = new MakeRegistration($personRepo, $paymentPlanRepo, $subscriptionRepo);
        $inputData = new MakeRegistrationInputData;

        $inputData->personId = 1;
        $inputData->paymentPlanId = 123;
        $inputData->createdAt = '2022-01-01 20:00:00';
        $output = $useCase->execute($inputData);

        $this->assertEquals($output->personId, 1);
        $this->assertEquals($output->price, 100);
        $this->assertEquals($output->createdAt, $inputData->createdAt);
        $this->assertEquals($output->status, 'PENDING');
        $this->assertEquals($output->paymentPlanId, 123);
        $this->assertNotEmpty($output->id);
    }

    public function testItShouldApplyVoucherWhenItIsProvided()
    {
        //Criando uma inscrição
        $personRepo = new PersonRepositoryMemory();
        $paymentPlanRepo = new PaymentPlanRepositoryMemory();
        $subscriptionRepo = new SubscriptionRepositoryMemory();
        $useCase = new MakeRegistration($personRepo, $paymentPlanRepo, $subscriptionRepo);
        $inputData = new MakeRegistrationInputData;

        $inputData->personId = 1;
        $inputData->paymentPlanId = 123;
        $inputData->createdAt = '2022-01-01 20:00:00';
        $outputSubscription = $useCase->execute($inputData);

        //Criando o voucher
        $subscriptionRepo = new SubscriptionRepositoryMemory();
        $voucherRepo = new VoucherRepositoryMemory();
        $useCase = new ApplyVoucher($voucherRepo, $subscriptionRepo);

        $inputData = new InputData();
        $inputData->voucherCode = 'DESCONTO';
        $inputData->subscriptionId = $outputSubscription->id;

        $output = $useCase->execute($inputData);

        $this->assertEquals($output->subscriptionId, $outputSubscription->id);
        $this->assertEquals($output->priceDiscount,  $output->priceDiscount);
        $this->assertEquals($output->priceWithDiscount, $outputSubscription->price - $output->priceDiscount);
    }

    public function testIfTheExceptionIsThrownWhenPersonIsInvalid()
    {
        $this->expectException(InvalidSubscriptionException::class);

        //Criando uma inscrição
        $personRepo = new PersonRepositoryMemory();
        $paymentPlanRepo = new PaymentPlanRepositoryMemory();
        $subscriptionRepo = new SubscriptionRepositoryMemory();
        $useCase = new MakeRegistration($personRepo, $paymentPlanRepo, $subscriptionRepo);
        $inputData = new MakeRegistrationInputData;

        $inputData->personId = 2;
        $inputData->paymentPlanId = 123;
        $inputData->createdAt = '2022-01-01 20:00:00';
        $useCase->execute($inputData);
    }

    public function testIfTheExceptionIsThrownWhenPaymentPlanIsInvalid()
    {
        $this->expectException(InvalidPaymentPlanException::class);

        //Criando uma inscrição
        $personRepo = new PersonRepositoryMemory();
        $paymentPlanRepo = new PaymentPlanRepositoryMemory();
        $subscriptionRepo = new SubscriptionRepositoryMemory();
        $useCase = new MakeRegistration($personRepo, $paymentPlanRepo, $subscriptionRepo);
        $inputData = new MakeRegistrationInputData;

        $inputData->personId = 1;
        $inputData->paymentPlanId = 1;
        $inputData->createdAt = '2022-01-01 20:00:00';
        $useCase->execute($inputData);
    }

    public function testIfTheExceptionIsThrownWhenVoucherIsInvalid()
    {
        $this->expectException(InvalidVoucherException::class);

        //Criando uma inscrição
        $personRepo = new PersonRepositoryMemory();
        $paymentPlanRepo = new PaymentPlanRepositoryMemory();
        $subscriptionRepo = new SubscriptionRepositoryMemory();
        $useCase = new MakeRegistration($personRepo, $paymentPlanRepo, $subscriptionRepo);
        $inputData = new MakeRegistrationInputData;

        $inputData->personId = 1;
        $inputData->paymentPlanId = 123;
        $inputData->createdAt = '2022-01-01 20:00:00';
        $outputSubscription = $useCase->execute($inputData);

        //Criando o voucher
        $subscriptionRepo = new SubscriptionRepositoryMemory();
        $voucherRepo = new VoucherRepositoryMemory();
        $useCase = new ApplyVoucher($voucherRepo, $subscriptionRepo);

        $inputData = new InputData();
        $inputData->voucherCode = 'DESCONTO2';
        $inputData->subscriptionId = $outputSubscription->id;

        $useCase->execute($inputData);
    }
}
