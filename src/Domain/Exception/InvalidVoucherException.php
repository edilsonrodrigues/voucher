<?php

namespace App\Domain\Exception;

use DomainException;

final class InvalidVoucherException extends DomainException
{
    public static function personOriginEqualpersonRegistration(): self
    {
        return new self(
            'Esse Vouche nao pode ser usado por voce, voce e o master'
        );
    }
}
