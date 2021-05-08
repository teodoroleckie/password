<?php

namespace Tleckie\Password;

use function preg_match;
use function sprintf;

/**
 * Class Requirements
 *
 * @package Tleckie\Password
 * @author  Teodoro Leckie Westberg <teodoroleckie@gmail.com>
 */
class Requirements implements RequirementsInterface
{
    /** @var string */
    protected const UPPER_REQUIRED = '(?=.*[A-Z])';

    /** @var string */
    protected const LOWER_REQUIRED = '(?=.*[a-z])';

    /** @var string */
    protected const NUMBER_REQUIRED = '(?=.*\d)';

    /** @var string */
    protected const SPECIAL_CHAR_REQUIRED = '(?=.*[_\W])';

    /** @var int */
    protected int $minSize;

    /** @var bool */
    protected bool $sameUpperChar;

    /** @var bool */
    protected bool $sameLowerChar;

    /** @var bool */
    protected bool $sameNumber;

    /** @var bool */
    protected bool $sameSpecialChar;

    /**
     * Requirements constructor.
     *
     * @param int  $minSize
     * @param bool $sameUpperChar
     * @param bool $sameNumber
     * @param bool $sameSpecialChar
     * @param bool $sameLowerChar
     */
    public function __construct(
        int $minSize = 8,
        bool $sameUpperChar = true,
        bool $sameNumber = true,
        bool $sameSpecialChar = true,
        bool $sameLowerChar = true
    ) {
        $this->minSize = $minSize;
        $this->sameUpperChar = $sameUpperChar;
        $this->sameNumber = $sameNumber;
        $this->sameSpecialChar = $sameSpecialChar;
        $this->sameLowerChar = $sameLowerChar;
    }

    /**
     * @inheritdoc
     */
    public function isValid(string $password): bool
    {
        return preg_match(
            $this->pattern(),
            $password,
        );
    }

    /**
     * @return string
     */
    protected function pattern(): string
    {
        $rules = [
            static::UPPER_REQUIRED,
            static::NUMBER_REQUIRED,
            static::SPECIAL_CHAR_REQUIRED,
            static::LOWER_REQUIRED,
        ];

        $requirements = [
            $this->sameUpperChar,
            $this->sameNumber,
            $this->sameSpecialChar,
            $this->sameLowerChar
        ];

        $regex = '';

        foreach ($requirements as $key => $requirement) {
            if ($requirement) {
                $regex .= $rules[$key];
            }
        }

        return sprintf(
            '/(%s).{%s,}/',
            $regex,
            $this->minSize
        );
    }
}
