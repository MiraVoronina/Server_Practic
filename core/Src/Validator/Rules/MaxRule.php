<?php

namespace Src\Validator\Rules;

class MaxRule
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
        if (empty($this->value) || empty($this->args[0])) {
            return true;
        }

        $maxLength = (int)$this->args[0];

        if (is_string($this->value)) {
            return mb_strlen($this->value) <= $maxLength;
        }

        if (is_numeric($this->value)) {
            return $this->value <= $maxLength;
        }

        return true;
    }

    public function validate(): string
    {
        if (!empty($this->message)) {
            return $this->message;
        }

        $maxLength = $this->args[0] ?? 0;
        return "Поле '{$this->fieldName}' должно содержать максимум {$maxLength} символов";
    }
}
