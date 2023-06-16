<?php

namespace App\Controller;

use App\Entity\UserTache;
use App\Repository\TacheRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UserTacheController extends AbstractController
{
    public function __construct(private RequestStack $requestStack)
    {

    }

    public function __invoke(EntityManagerInterface $entityManager,UserRepository $userRepository,TacheRepository $tacheRepository)
    {
        $userid = json_decode($this->requestStack->getCurrentRequest()->getContent())->userid;
        $role = json_decode($this->requestStack->getCurrentRequest()->getContent())->role;
        $tacheid = json_decode($this->requestStack->getCurrentRequest()->getContent())->tacheid;
        $userTache = new UserTache();
        $userTache->setTache($tacheRepository->find($tacheid));
        $userTache->setRole($role);
        $userTache->setUserId($userRepository->find($userid));
        $entityManager->persist($userTache);
        $entityManager->flush();
        return $userTache;

    }
}
