<?php

namespace Src\Validator\Rules;

class NumericRule
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
        if (empty($this->value) && $this->value !== '0' && $this->value !== 0) {
            return true;
        }

        return is_numeric($this->value);
    }

    public function validate(): string
    {
        if (!empty($this->message)) {
            return $this->message;
        }

        return "Поле '{$this->fieldName}' должно быть числом";
    }
}
