<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Voucher;

interface VoucherRepository
{
    public function findByVoucherCode(string $voucherCode): ?Voucher;
}
