<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class RequireValidator extends AbstractValidator
{
    protected string $message = 'Поле :field пусто';

    public function rule(): bool
    {
        return !empty($this->value);
    }
}
