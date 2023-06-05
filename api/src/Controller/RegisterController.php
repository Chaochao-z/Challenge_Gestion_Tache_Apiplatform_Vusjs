<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mime\Address;


class RegisterController extends AbstractController
{
    public function __construct(private RequestStack $requestStack)
    {

    }
    public function __invoke(EntityManagerInterface $entityManager,UserRepository $userRepository,UserPasswordHasherInterface $userPasswordHasher,MailerInterface $mailer)
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
        $user->setToken(bin2hex(random_bytes(32)));
        $user->setTokenEcheance(new \DateTimeImmutable());
        $emailconfig = (new TemplatedEmail())
            ->from(new Address('panama@easylocmoto.fr','Panama Agency'))
            ->to($email)
            ->subject('Verify your account')
            ->htmlTemplate('mail/Verify-account.html.twig')
            ->context([
                'name'=> $user->getUsername(),
                'token' => $user->getToken(),
                'url' => $_ENV['FRONT_URL']
            ]);
        $mailer->send($emailconfig);

        $entityManager->persist($user);
        $entityManager->flush();
        return $user;

    }

}
