<?php

namespace App\Domain\UseCases\ApplyVoucher;

use App\Domain\Exception\EqualPersonOriginException;
use App\Domain\Repository\SubscriptionRepository;
use App\Domain\Repository\VoucherRepository;
use Tests\Integration\Domain\UseCases\InvalidVoucherException;

class ApplyVoucher
{
    public function __construct(private VoucherRepository $voucherRepo, private SubscriptionRepository $subscriptionRepo)
    {
    }

    public function execute(InputData $inputData): OutputData
    {
        $subscription = $this->subscriptionRepo->findById($inputData->subscriptionId);

        $voucher =  $this->voucherRepo->findByVoucherCode($inputData->voucherCode);
        $subscription->applyVoucher($voucher);

        $outputData = new OutputData;
        $outputData->id = $voucher->id;
        $outputData->priceDiscount = $voucher->price;
        $outputData->subscriptionId = $subscription->id;
        $outputData->priceWithDiscount = $subscription->price;
        return $outputData;
    }
}
