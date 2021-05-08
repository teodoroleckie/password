<?php

namespace Tleckie\Password;

/**
 * Class Validator
 *
 * @package Tleckie\Password
 * @author  Teodoro Leckie Westberg <teodoroleckie@gmail.com>
 */
class Validator implements ValidatorInterface
{
    /** @var RequirementsInterface */
    protected RequirementsInterface $requirements;

    /** @var HashInterface */
    protected HashInterface $hash;

    /**
     * Validator constructor.
     *
     * @param RequirementsInterface|null $requirements
     * @param HashInterface|null         $hash
     */
    public function __construct(
        RequirementsInterface $requirements = null,
        HashInterface $hash = null
    ) {
        $this->requirements = $requirements ?? new Requirements();
        $this->hash = $hash ?? new Hash();
    }

    /**
     * @inheritdoc
     */
    public function isValid(string $password): bool
    {
        return $this->requirements->isValid($password);
    }

    /**
     * @inheritdoc
     */
    public function createHash(string $password): string
    {
        return $this->hash->createHash($password);
    }

    /**
     * @inheritdoc
     */
    public function passwordVerify(string $password, string $hash): bool
    {
        return $this->hash->passwordVerify($password, $hash);
    }
}
