<?php

namespace Tleckie\Password\Tests;

use PHPUnit\Framework\TestCase;
use Tleckie\Password\Hash;

/**
 * Class HashTest
 *
 * @package Tleckie\Password\Tests
 * @author  Teodoro Leckie Westberg <teodoroleckie@gmail.com>
 */
class HashTest extends TestCase
{
    /**
     * @test
     * @dataProvider passwordVerifyDataProvider
     * @param string $password
     * @param string $hash
     * @param bool   $expected
     */
    public function passwordVerify(
        string $password,
        string $hash,
        bool $expected,
    ): void {
        $hashGenerator = new Hash();

        static::assertEquals($expected, $hashGenerator->passwordVerify($password, $hash));
    }

    /**
     * @test
     * @dataProvider createHashDataProvider
     * @param string $password
     */
    public function createHash(string $password): void
    {
        $hashGenerator = new Hash();

        $hash = $hashGenerator->createHash($password);

        static::assertIsString($hash);

        static::assertTrue($hashGenerator->passwordVerify($password, $hash));
    }

    /**
     * @return array
     */
    public function createHashDataProvider(): array
    {
        return [
            ['test1'],
            ['test1A'],
            ['test1A.test'],
            ['OtherTest1A.test'],
            ['Other#Test1A.test'],
            ['Other#9542Test1A.test'],
            ['Other#9542.Test1A.test'],
            ['Other#9542.Test1A.test'],
        ];
    }

    /**
     * @return array[]
     */
    public function passwordVerifyDataProvider(): array
    {
        return [
            ['Secure123.Validator','$2y$06$NThLfyEN/mu1vgAPudRm4u2BPWDZpkCWJfhS4q.NLyAR1d6Iaf2EG' ,true],
            ['Secure123.Validator','$2y$06$1kuu.Q6DncxRA1rQfzHqG.zbMnZxmcUVP0HEp/sjlw3Lu.RhHo5zu' ,true],
            ['Secure123.Validator','$2y$06$dBh.tQs1PTfPVPujjT3pc.aGHTI2lSYpIIs59VBqniSr17Nz/xOAi' ,true],
            ['Secure123.Validator123','$2y$06$YXxnpIs.GHsyPb7SHJr7G.ch9Dtvwiup3haTvjWFec/bAFOjgdjdG' ,true],
            ['Secure123.Validator123','$2y$06$HMNABNoVMtIzl2boHIOaWupbPZomZBr6PAZLuvSRW9kSWN7.QQMQq' ,true],
            ['Secure123.Validator123','$2y$06$HMNABNoVMtIzl2boHIOaWupbPZomZBr6PAZLuvSRW9kSWN7.QQMQq2' ,false],
        ];
    }
}
