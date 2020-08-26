<?php

namespace App\Validations;

use Phalcon\Validation\Validator\Between;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Numericality;
use Phalcon\Validation\Validator\Regex;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\StringLength\Max;

class RegisterFormValidator extends BaseValidator
{
    public function initialize()
    {

        $this->required('firstName', 'lastName', 'age', 'phone', 'licenseNumber', 'password');

        $this->firstAndLastNames();
        $this->age();
        $this->phone();
        $this->driversLicenseNumber();
        $this->password();
        $this->address();
    }

    protected function firstAndLastNames()
    {
        $this->add([
            "firstName",
            "lastName",
        ], new StringLength([
            "max"             => [
                "firstName" => 50,
                "lastName"  => 50,
            ],
            "min"             => [
                "firstName" => 2,
                "lastName"  => 2,
            ],
            "messageMaximum"  => [
                "firstName" => "First name too long (max: 50)",
                "lastName"  => "First name too long (max: 50)",
            ],
            "messageMinimum"  => [
                "firstName" => "First name too short (min: 2)",
                "lastName"  => "Last name too short (min: 2",
            ],
            "includedMaximum" => [
                "firstName" => false,
                "lastName"  => false,
            ],
            "includedMinimum" => [
                "firstName" => false,
                "lastName"  => false,
            ],
        ]));
    }

    protected function age()
    {
        $this->add('age', new Between([
            'minimum' => 1,
            'maximum' => 99,
            'message' => 'The age  must be between 1 and 99',
        ]));

        $this->add('age', new Numericality([
            'message' => 'The age  must be numeric',
        ]));
    }

    protected function phone()
    {
        $this->add('phone', new Regex([
            'message' => 'The phone number is not valid',
            'pattern' => '/[0-9]{10}/',
        ]));
    }

    protected function driversLicenseNumber()
    {
        $this->add('licenseNumber', new Regex([
            'message' => 'The driver\'s license number is not valid',
            'pattern' => '/[A-z][0-9]{4}(-[0-9]{5}){2}/',
        ]));
    }

    protected function password()
    {
        $this->add("password", new StringLength([
            "max"             => 50,
            "min"             => 6,
            "messageMaximum"  => "The password is too long (max: 50)",
            "messageMinimum"  => "The password is too short (min: 6)",
            "includedMaximum" => false,
            "includedMinimum" => false,
        ]));
    }

    protected function address()
    {
        $this->add('address', new Max([
            'max'      => 1000,
            'message'  => 'The address is too long (max: 1000)',
            "included" => true,
        ]));
    }
}