<?php

namespace App\Validations;

use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Helper\Str;

class BaseValidator extends Validation
{
    protected function required(...$fields)
    {
        foreach ($fields as $field) {
            $fieldInMessage = Str::uncamelize($field, ' ');
            $this->add($field, new PresenceOf([
                'message' => "The $fieldInMessage is required",
            ]));
        }
    }
}