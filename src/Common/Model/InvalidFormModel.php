<?php

namespace App\Common\Model;

class InvalidFormModel
{
    private int $code;

    private string $message;

    /**
     * @var InvalidFormItemModel[]
     */
    private array $errors;

    /**
     * InvalidFormModel constructor.
     *
     * @param int                    $code
     * @param string                 $message
     * @param InvalidFormItemModel[] $errors
     */
    public function __construct(int $code, string $message, array $errors)
    {
        $this->code = $code;
        $this->message = $message;
        $this->errors = $errors;
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return InvalidFormItemModel[]
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
