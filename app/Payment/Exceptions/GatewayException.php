<?php

declare(strict_types=1);

namespace App\Payment\Exceptions;

use Exception;

class GatewayException extends Exception
{
    public function __construct(
        string $message,
        int $code = 0,
        protected string $gateway = '',
        protected array $context = [],
        ?\Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }

    public function getGateway(): string
    {
        return $this->gateway;
    }

    public function getContext(): array
    {
        return $this->context;
    }
}
