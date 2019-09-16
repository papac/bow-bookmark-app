<?php

namespace App\Exception;

use Exception;
use Bow\Validation\Validate;

class UserValidation extends Exception
{
    /**
     * The validation data
     * 
     * @var Validate
     */
    private $validation;

    /**
     * Set the error validation
     * 
     * @param Validate $validation
     * @return void
     */
    public function setValidation($validation)
    {
        $this->validation = $validation;
    }
}
