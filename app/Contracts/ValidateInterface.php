<?php

namespace App\Contracts;

interface ValidateInterface
{    
    /**
     * Validate data before save
     *
     * @param  array $request
     * @return object
     */
    public function validate(array $request);
}