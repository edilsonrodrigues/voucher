<?php

namespace App\Domain\Exception;

use DomainException;

final class InvalidSubscriptionException extends DomainException
{
    public static function personIsNotValid(): self
    {
        return new self(
            'Pessoa não encontrada'
        );
    }
}
