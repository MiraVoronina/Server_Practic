<?php

namespace Src\Validator\Rules;

class RequiredRule
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
        if (is_null($this->value)) {
            return false;
        }

        if (is_string($this->value) && trim($this->value) === '') {
            return false;
        }

        if (is_array($this->value) && empty($this->value)) {
            return false;
        }

        return true;
    }

    public function validate(): string
    {
        if (!empty($this->message)) {
            return $this->message;
        }

        return "Поле '{$this->fieldName}' обязательно для заполнения";
    }
}
