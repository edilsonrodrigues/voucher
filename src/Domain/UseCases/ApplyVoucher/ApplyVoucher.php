<?php

namespace App\Domain\UseCases\ApplyVoucher;

use App\Domain\Exception\EqualPersonOriginException;
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
        $subscription = $this->subscriptionRepo->findById($inputData->subscriptionId);

        $outputData = new OutputData;
        $outputData->id = $voucher->id;
        $outputData->originPersonId = $voucher->originPersonId;
        $outputData->subscriptionId = $subscription->id;
        $outputData->status = 2;
        return $outputData;
    }
}
