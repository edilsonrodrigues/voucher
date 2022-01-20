<?php

namespace App\Infra\Repository;

use App\Domain\Entity\Voucher;
use App\Domain\Repository\VoucherRepository;

class VoucherRepositoryMemory implements VoucherRepository
{
    public function findByVoucherCode(string $voucherCode): Voucher
    {
        $voucher = new Voucher;
        $voucher->id = 1;
        $voucher->price = 20;
        return $voucher;
    }
}
