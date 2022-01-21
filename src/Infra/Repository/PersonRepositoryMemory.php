<?php

namespace App\Infra\Repository;

use App\Domain\Entity\Person;
use App\Domain\Repository\PersonRepository;

class PersonRepositoryMemory implements PersonRepository
{
    public function __construct(private array $storage = [])
    {
        $person = new Person;
        $person->id = 1;
        $person->name = 'Edilson';
        $person->email = 'edilson@itarget.com.br';
        $this->storage[] = $person;
    }

    public function findById(int $id): ?Person
    {
        $person = array_filter(
            $this->storage,
            function ($person) use ($id) {
                return $person->id == $id;
            }
        );

        return count($person) ? current($person) : null;
    }
}
