<?php

namespace Src\Validator;

abstract class AbstractValidator
{
    protected string $field = '';
    protected $value;
    protected array $args = [];
    protected array $messageKeys = [];
    protected string $message = '';

    public function __construct(string $fieldName, $value, $args = [], string $message = null)
    {
        $this->field = $fieldName;
        $this->value = $value;
        $this->args = $args;
        $this->message = $message ?? $this->message;

        $this->messageKeys = [
            ':value' => $this->value,
            ':field' => $this->field,
        ];
    }

    abstract public function rule(): bool;

    public function validate(): string
    {
        return str_replace(array_keys($this->messageKeys), array_values($this->messageKeys), $this->message);
    }
}
