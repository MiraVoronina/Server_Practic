<?php

namespace Src\Validator\Rules;

class EmailRule
{
    private string $fieldName;
    private $value;
    private array $args;
    private string $message;

    public function __construct(string $fieldName, $value, array $args = [], string $message = '')
    {
        $this->fieldName = $fieldName;
        $this->value = $value;
        $this->args = $args;
        $this->message = $message;
    }

    public function rule(): bool
    {
        if (empty($this->value)) {
            return true;
        }

        return filter_var($this->value, FILTER_VALIDATE_EMAIL) !== false;
    }

    public function validate(): string
    {
        if (!empty($this->message)) {
            return $this->message;
        }

        return "Поле '{$this->fieldName}' должно быть корректным email адресом";
    }
}
