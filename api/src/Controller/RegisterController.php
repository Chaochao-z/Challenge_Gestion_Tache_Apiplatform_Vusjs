<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    public function __construct(private RequestStack $requestStack)
    {

    }
    public function __invoke(EntityManagerInterface $entityManager,UserRepository $userRepository,UserPasswordHasherInterface $userPasswordHasher)
    {
        $username = json_decode($this->requestStack->getCurrentRequest()->getContent())->username;
        $email = json_decode($this->requestStack->getCurrentRequest()->getContent())->email;
        $roles = json_decode($this->requestStack->getCurrentRequest()->getContent())->role;
        $password = json_decode($this->requestStack->getCurrentRequest()->getContent())->password;

        if($user = $userRepository->findOneBy(['username' => $username])){
            throw $this->createNotFoundException('User with username already exists');
        }
        if($user = $userRepository->findOneBy(['mail' => $email])){
            throw $this->createNotFoundException('User with email already exists');
        }

        $user = new User();
        $user->setUsername($username);
        $user->setMail($email);
        $user->setRoles($roles);
        $user->setPassword($userPasswordHasher->hashPassword($user,$password));
        $entityManager->persist($user);
        $entityManager->flush();
        return $user;

    }

}
