<?php


namespace App;


use App\Entity\Users;
use App\Repository\UserRepository;
use Doctrine\Bundle\DoctrineBundle\Registry;

class UserService
{

    private $_userRepository;

    public function __construct(Registry $registry)
    {
        $this -> _userRepository = new UserRepository($registry);
    }

    public function getAllUsers() : array
    {
        return $this -> _userRepository -> findAll();
    }

    public function getUserById(int $id) : Users
    {
        return $this -> _userRepository -> find($id);
    }
}