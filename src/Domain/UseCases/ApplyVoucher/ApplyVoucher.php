<?php

namespace App\Domain\UseCases\ApplyVoucher;

use App\Domain\Repository\VoucherRepository;
use Tests\Integration\Domain\UseCases\SubscriptionRepository;

class ApplyVoucher
{
    public function __construct(private VoucherRepository $voucherRepo, private SubscriptionRepository $subscriptionRepo)
    {
    }

    public function execute(InputData $inputData): OutputData
    {
        $voucher =  $this->voucherRepo->findByVoucherCode($inputData->voucherCode);
        $outputData = new OutputData;
        $outputData->id = $voucher->id;

        return $outputData;
    }
}
