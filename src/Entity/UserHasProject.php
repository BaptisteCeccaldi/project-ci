<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserHasProjectRepository")
 */
class UserHasProject
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     */
    private $user_id;

    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     */
    private $project_id;

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function getProjectId(): ?int
    {
        return $this->project_id;
    }
}
