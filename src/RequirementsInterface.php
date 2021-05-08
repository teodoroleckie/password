<?php

namespace Tleckie\Password;

/**
 * Interface RequirementsInterface
 *
 * @package Tleckie\Password
 * @author  Teodoro Leckie Westberg <teodoroleckie@gmail.com>
 */
interface RequirementsInterface
{
    /**
     * @param string $password
     * @return bool
     */
    public function isValid(string $password): bool;
}
