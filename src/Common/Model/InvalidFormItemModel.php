<?php

namespace App\Common\Model;

class InvalidFormItemModel
{
    private string $field;
    private string $error_message;

    /**
     * InvalidFormItemModel constructor.
     *
     * @param string $field
     * @param string $error_message
     */
    public function __construct(string $field, string $error_message)
    {
        $this->field = $field;
        $this->error_message = $error_message;
    }

    /**
     * @return string
     */
    public function getField(): string
    {
        return $this->field;
    }

    /**
     * @return string
     */
    public function getErrorMessage(): string
    {
        return $this->error_message;
    }
}
