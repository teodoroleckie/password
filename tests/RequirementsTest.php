<?php

namespace Tleckie\Password\Tests;

use PHPUnit\Framework\TestCase;
use Tleckie\Password\Requirements;

/**
 * Class RequirementsTest
 *
 * @package Tleckie\Password\Tests
 * @author  Teodoro Leckie Westberg <teodoroleckie@gmail.com>
 */
class RequirementsTest extends TestCase
{
    /**
     * @test
     * @dataProvider validatorDataProvider
     * @param int    $minSize
     * @param bool   $sameUpperChar
     * @param bool   $sameNumber
     * @param bool   $sameSpecialChar
     * @param bool   $sameLowerChar
     * @param string $password
     * @param bool   $expected
     */
    public function isValid(
        int $minSize,
        bool $sameUpperChar,
        bool $sameNumber,
        bool $sameSpecialChar,
        bool $sameLowerChar,
        string $password,
        bool $expected
    ): void {
        $requirements = new Requirements($minSize, $sameUpperChar, $sameNumber, $sameSpecialChar, $sameLowerChar);
        static::assertEquals($expected, $requirements->isValid($password));
    }

    /**
     * @return array[]
     */
    public function validatorDataProvider(): array
    {
        return [
            [8,true,true,true,true, 'tes.T123', true],
            [10,true,true,true,true, 'tes.T123', false],
            [9,true,true,true,true, 'tes.T123', false],
            [9,true,true,true,true, 'tes.t123', false],
            [9,true,true,true,true, 'tes.Taaaa', false],
            [12,true,true,true,true, '4444.T111111', false],
            [8,false,true,true,true, 'tes.T123', true],
            [8,false,false,true,true, 'tes.T123', true],
            [8,false,false,false,true, 'tes.T123', true],
            [8,false,false,false,false, 'tes.T123', true],
        ];
    }
}
