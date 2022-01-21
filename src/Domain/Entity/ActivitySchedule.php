<?php

namespace App\Domain\Entity;

class ActivitySchedule
{
    public int $id;
    public string $description;
    public Activity $activity;
}
