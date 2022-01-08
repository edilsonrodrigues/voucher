<?php
namespace App\Domain\Repository;

use App\Domain\Entity\Person;

interface PersonRepository
{
    public function findById(int $id): Person;
}
