<?php

namespace Tleckie\Password;

/**
 * Interface HashInterface
 *
 * @package Tleckie\Password
 * @author  Teodoro Leckie Westberg <teodoroleckie@gmail.com>
 */
interface HashInterface
{
    /**
     * @param string $password
     * @return string
     */
    public function createHash(string $password): string;

    /**
     * @param string $password
     * @param string $hash
     * @return bool
     */
    public function passwordVerify(string $password, string $hash): bool;
}
