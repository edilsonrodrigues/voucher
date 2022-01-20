<?php

namespace App\Domain\Entity;

class PaymentPlan
{
    public int $id;
    public ProfessionalCategory $professionalCategory;
    public Activity $activity;
}
