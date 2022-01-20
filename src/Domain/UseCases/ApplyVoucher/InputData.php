<?php

namespace App\Domain\UseCases\ApplyVoucher;

class InputData
{
    public int $subscriptionId;
    public string $voucherCode;
    public int $personOriginId;
}
