<?php

namespace App\Repository;

use App\Entity\UserHasProject;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UserHasProject|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserHasProject|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserHasProject[]    findAll()
 * @method UserHasProject[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserHasProjectRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UserHasProject::class);
    }


}
