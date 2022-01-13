<?php

namespace App\Tests\unit;

use App\Service\UserHelper;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\Boolean;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserHelperTest extends TestCase
{
    private UserHelper $UserHelperMock;
    private $EmMock;

    /*
     * protected function setUp(): void
        {
            $this->UserPasswordEncoderInterface = $this->createMock(UserPasswordEncoderInterface::class);
            $this->UserRepositoryMock = $this->createMock(UserRepository::class);
            $this->UserRepositoryMock->method('findAll')->willReturn([]);
            $this->EmMock = $this->createMock(EntityManagerInterface::class);

            $this->UserHelperMock = new UserHelper($this->UserRepositoryMock, $this->EmMock, $this->UserPasswordEncoderInterface);

            parent::setUp();
         }
     * */

    //** Setup's */
    protected function setUpUser(): void
    {
        $this->UserPasswordEncoderInterface = $this->createMock(UserPasswordEncoderInterface::class);
        $this->UserRepositoryMock = $this->createMock(UserRepository::class);
        $this->UserRepositoryMock->method('findAll')->willReturn([]);
        $this->EmMock = $this->createMock(EntityManagerInterface::class);

        $this->UserHelperMock = new UserHelper($this->EmMock, $this->UserRepositoryMock);

        parent::setUp();
    }

    protected function setUpVCode(): void
    {
        $this->UserPasswordEncoderInterface = $this->createMock(UserPasswordEncoderInterface::class);
        $this->UserRepositoryMock = $this->createMock(UserRepository::class);
        $this->UserRepositoryMock->method('findAll')->willReturn([]);
        $this->EmMock = $this->createMock(EntityManagerInterface::class);

        $this->UserHelperMock = new UserHelper($this->EmMock, $this->UserRepositoryMock);

        parent::setUp();
    }

    public function testValidateUsername(){
        $input = 'Mike';
        $response = $this->UserHelperMock->validateUsername($input);
        $this->assertEquals(true, $response);
    }
}