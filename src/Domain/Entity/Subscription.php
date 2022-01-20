<?php

namespace App\Domain\Entity;

use DateTimeImmutable;
use DateTimeInterface;

class Subscription
{
    public int $id;
    public Person $person;
    public string $status;
    public DateTimeInterface $createdAt;
    public ?Voucher $voucher;
    public ?DateTimeInterface $voucherAppliedAt;
    public float $price;

    public function markAsPending(DateTimeInterface $createdAt)
    {
        $this->status = 'PENDING';
        $this->createdAt = $createdAt;
    }

    public function applyVoucher(Voucher $voucher)
    {
        $this->voucher = $voucher;
        $this->price = $this->price - $voucher->price;
        $this->voucherAppliedAt = new DateTimeImmutable();
    }
}
