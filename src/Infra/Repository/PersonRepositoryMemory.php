<?php

namespace App\Infra\Repository;

use App\Domain\Entity\Person;
use App\Domain\Repository\PersonRepository;

class PersonRepositoryMemory implements PersonRepository
{
    public function findById(int $id): Person
    {
        $person = new Person;
        $person->id = 1;
        $person->name = 'Edilson';
        $person->email = 'edilson@itarget.com.br';
        return $person;
    }
}
