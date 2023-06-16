<?php

namespace App\Controller;

use App\Entity\UserTache;
use App\Repository\TacheRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserDashboardTacheController extends AbstractController
{
    public function __construct(private RequestStack $requestStack)
    {

    }

    public function __invoke(EntityManagerInterface $entityManager,UserRepository $userRepository,TacheRepository $tacheRepository)
    {
        $userid = json_decode($this->requestStack->getCurrentRequest()->getContent())->userid;
        $titre = json_decode($this->requestStack->getCurrentRequest()->getContent())->titre;

        $tache = $tacheRepository->findOneBy(['titre' => $titre]);
        $user = $userRepository->find($userid);

        $userTache = new UserTache();
        $userTache->setUserId($user);
        $userTache->setTache($tache);
        $userTache->setRole('auteur');
        $entityManager->persist($userTache);
        $entityManager->flush();
        return $userTache;

    }
}
