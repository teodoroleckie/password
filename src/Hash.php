<?php

namespace Tleckie\Password;

use function password_hash;
use function password_verify;

/**
 * Class Hash
 *
 * @package Tleckie\Password
 * @author  Teodoro Leckie Westberg <teodoroleckie@gmail.com>
 */
class Hash implements HashInterface
{
    /**
     * @inheritdoc
     */
    public function passwordVerify(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }

    /**
     * @inheritdoc
     */
    public function createHash(string $password): string
    {
        return password_hash($password, \PASSWORD_BCRYPT);
    }
}
