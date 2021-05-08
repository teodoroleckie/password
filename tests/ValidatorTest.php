<?php

namespace Tleckie\Password\Tests;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Tleckie\Password\HashInterface;
use Tleckie\Password\RequirementsInterface;
use Tleckie\Password\Validator;
use Tleckie\Password\ValidatorInterface;

/**
 * Class ValidatorTest
 *
 * @package Tleckie\Password\Tests
 * @author  Teodoro Leckie Westberg <teodoroleckie@gmail.com>
 */
class ValidatorTest extends TestCase
{
    /** @var RequirementsInterface|MockObject */
    private RequirementsInterface|MockObject $requirementsMock;

    /** @var HashInterface|MockObject */
    private HashInterface|MockObject $hashMock;

    /** @var ValidatorInterface */
    private ValidatorInterface $validator;

    /**
     * @test
     */
    public function isValid(): void
    {
        $pass = 'passWord.1234';
        $this->requirementsMock->expects(static::once())
            ->method('isValid')
            ->with($pass)
            ->willReturn(true);

        static::assertTrue($this->validator->isValid($pass));
    }

    /**
     * @test
     */
    public function createHash(): void
    {
        $pass = 'passWord.1234';
        $this->hashMock->expects(static::once())
            ->method('createHash')
            ->with($pass)
            ->willReturn('$2y$06$NThLfyEN/mu1vgAPudRm4u2BPWDZpkCWJfhS4q.NLyAR1d6Iaf2EG');

        static::assertIsString($this->validator->createHash($pass));
    }

    protected function setUp(): void
    {
        $this->requirementsMock = $this->createMock(RequirementsInterface::class);

        $this->hashMock = $this->createMock(HashInterface::class);

        $this->validator = new Validator($this->requirementsMock, $this->hashMock);
    }
}
