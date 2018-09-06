<?php

namespace App\Validation;

use Respect\Validation\Exceptions\NestedValidationException;

class Validator {

    /** @var array Validations errors */
    protected $errors = [];

    /**
     * Validate an array of values and fields
     *
     * @param array $values
     * @param array $rules
     *
     * @return static
     */
    public function validate(string $value, array $rules) {
        /** @var \Respect\Validation\Validator $rule */
        foreach ($rules as $field => $rule) {
            try {
                $rule->setName($field)->assert($value);
            } catch (NestedValidationException $e) {
                $this->errors[$field] = $e->getMessages();
            }
        }
        $_SESSION['errors'] = $this->errors;

        return $this;
    }

    /**
     * Check if there is any validation error
     *
     * @return bool
     */
    public function failed() {
        return ! empty($this->errors);
    }

    /**
     * Return all validations errors if any
     *
     * @return array
     */
    public function getErrors() {
        return $this->errors;
    }
}