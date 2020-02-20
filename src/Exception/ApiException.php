<?php


namespace App\Exception;

use Exception;

class ApiException extends Exception
{
    const DEFAULT_HTTP_STATUS = 503;
    const DEFAULT_MESSAGE = 'Sorry, an error occured. Please, try your request later';

    private $context;

    public function __construct(
        string $message = self::DEFAULT_MESSAGE,
        int $status = self::DEFAULT_HTTP_STATUS,
        array $context = [],
        $previous = null
    ) {
        parent::__construct($message, $status, $previous);
        $this->context = $context;
    }

    public function getContext(): array
    {
        return $this->context;
    }

    public function getHttpStatus(): int
    {
        return $this->getCode();
    }
}