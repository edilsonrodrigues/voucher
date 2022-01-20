<?php

namespace App\Domain\UseCases\ApplyVoucher;

class OutputData
{
    public int $id;
    public int $subscriptionId;
    public float $priceDiscount;
    public float $priceWithDiscount;
}
