<?php


namespace App\Tests\Repository;




use App\Controller\UserController;

use App\Entity\Users;
use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Response;

class UserRepository extends KernelTestCase
{

    /** @var \App\Repository\UserRepository|MockObject */
    private $userRepositoryMock;
    /** @var UserController|MockObject */
    private $userControllerMock;

    public function getAllActionDataProvider()
    {
        $c0 = [];
        $customers0 = [$c0];

        $c1 = new Users();
        $c1->setFirstname('Ceccaldi');
        $c1->setLastname('Jean-Baptiste');
        $customers1 = [$c1];

        $c2 = new Users();
        $c2->setFirstname('Thuillier');
        $c2->setLastname('Marie');
        $customers2 = [$c1, $c2];

        return [
            [$customers0],
            [$customers1],
            [$customers2]
        ];
    }

    /**
     * {@inheritDoc}
     */
    protected function setUp() : void
    {
        $this->userRepositoryMock = $this->getMockBuilder(\App\Repository\UserRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->userControllerMock = new UserController();
    }

    /**
     * @dataProvider getAllActionDataProvider
     * @param $customers
     */
    public function testGetAllAction($customers)
    {
        $this->userRepositoryMock
            ->expects($this->once())
            ->method('findAll')
            ->willReturn($customers);

        $result = $this->userControllerMock->getAll($this->userRepositoryMock);

        $response = new Response(json_encode($customers));
        $this->assertEquals($response, $result);
    }

    public function testGetOneAction()
    {
        $id = 1;

        $customer = new Users();
        $customer->setFirstname('Ceccaldi');
        $customer->setLastname('Jean-Baptiste');

        $this->userRepositoryMock
            ->expects($this->once())
            ->method('find')
            ->with($id)
            ->willReturn($customer);

        $result = $this->userControllerMock->getOne($id,$this->userRepositoryMock);

        $response = new Response(json_encode($customer));

        $this->assertEquals($response, $result);
    }

    protected function tearDown(): void
    {
        $this->userRepositoryMock = null;
        $this->userControllerMock = null;
    }
}