<?php

namespace App\State;

use App\Entity\User;
use App\Dto\UserVerifyEmailDto;
use ApiPlatform\Metadata\Operation;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\State\ProcessorInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class UserUpdateProcessor implements ProcessorInterface
{

    public function __construct(private EntityManagerInterface $em){}

    public function process($data, Operation $operation, array $uriVariables = [], array $context = []): ?User
    {
        $user = $this->em->getRepository(User::class)->find($data->id);
        if(!$user){
            throw new NotFoundHttpException('User not found or token already used');
        }
        $user->setMail($data->mail);
        $this->em->flush();
        return $user;
    }
}
