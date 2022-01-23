<?php

namespace App\Domain\Exception;

use DomainException;

final class InvalidPaymentPlanException extends DomainException
{
    public static function paymentPlanIsNotValid(): self
    {
        return new self(
            'plano de pagamento não encontrada'
        );
    }
}
