<?php

namespace App\Domain\Entity;

class Voucher
{
    public int $id;
    public int $status;
    public int $originPersonId;
    public int $centerCostId;
    public int $scheduleActivityId;
}
