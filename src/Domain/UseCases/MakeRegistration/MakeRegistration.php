<?php

namespace App\Domain\UseCases\MakeRegistration;

use App\Domain\Repository\PersonRepository;

class MakeRegistration
{
    public function __construct(private PersonRepository $personRepo)
    {
    }

    public function execute(InputData $inputData): OutputData
    {
        $person = $this->personRepo->findById($inputData->personId);

        $outputData = new OutputData;
        $outputData->id = 1;
        $outputData->personId = $person->id;

        return $outputData;
    }
}
