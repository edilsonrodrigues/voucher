<?php

declare(strict_types=1);

namespace Tests\Integration\Domain\UseCases;

use App\Domain\UseCases\MakeRegistration\InputData;
use App\Domain\UseCases\MakeRegistration\MakeRegistration;
use App\Infra\Repository\PersonRepositoryMemory;
use PHPUnit\Framework\TestCase;

class SubscriptionTest extends TestCase
{
    public function testItShouldMakeSubscriptionWhenValidDataIsProvided()
    {
        $personRepo = new PersonRepositoryMemory();
        $useCase = new MakeRegistration($personRepo);
        $inputData = new InputData;

        $inputData->personId = 1;
        $inputData->paymentPlanId = 123;

        $output = $useCase->execute($inputData);

        $this->assertEquals($output->personId, 1);
        $this->assertNotEmpty($output->id);
    }
}
