<?php


namespace App\Controller;


use App\Entity\Users;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Symfony\Component\Routing\Annotation\Route("/user/")
 */
class UserController extends AbstractController
{

    /**
     * @Symfony\Component\Routing\Annotation\Route("list")
     * @param UserRepository $repository
     * @return Response
     */
    public function getAll(UserRepository $repository){
        return new Response(json_encode($repository->findAll()));
    }

    /**
     * @Symfony\Component\Routing\Annotation\Route("list/{id}")
     * @param int $id
     * @param UserRepository $repository
     * @return Response
     */
    public function getOne(int $id, UserRepository $repository){
        return new Response($repository->find($id));
    }

    /**
     * @Symfony\Component\Routing\Annotation\Route("create-user", methods="POST")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function create(Request $request, EntityManagerInterface $em){
        if(empty($request->get('firstname')))
            return new Response(json_encode(['state' => 'ko', 'message' => 'FirstName is empty']));
        if(empty($request->get('lastname')))
            return new Response(json_encode(['state' => 'ko', 'message' => 'LastName is empty']));

        $user = new Users();
        $user -> setFirstname($request->get('firstname'));
        $user -> setLastname($request->get('lastname'));
        $em->persist($user);
        $em->flush();
        return new Response(json_encode(['state' => 'ok']));
    }

    /**
     * @Symfony\Component\Routing\Annotation\Route("update-user/{id}", methods="POST")
     * @param int $id
     * @param Request $request
     * @param UserRepository $repository
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function update(int $id, Request $request, UserRepository $repository, EntityManagerInterface $entityManager){
        $user = $repository->find($id);
        if(is_null($user))
            return new Response(json_encode(['state' => 'ko', 'message' => 'incorrect id']));
        if(!empty($request->get('firstname')))
            $user -> setFirstname($request->get('firstname'));
        if(!empty($request->get('lastname')))
            $user -> setLastname($request->get('lastname'));
        $entityManager->merge($user);
        $entityManager->flush();
        return new Response(json_encode(['state' => 'ok']));
    }

    /**
     * @Symfony\Component\Routing\Annotation\Route("delete-user/{id}", methods="POST")
     * @param int $id
     * @param UserRepository $repository
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function delete(int $id, UserRepository $repository, EntityManagerInterface $entityManager){
        $user = $repository->find($id);
        if(is_null($user))
            return new Response(json_encode(['state' => 'ko', 'message' => 'incorrect id']));
        $entityManager->remove($user);
        $entityManager->flush();
        return new Response(json_encode(['state' => 'ok']));
    }


}