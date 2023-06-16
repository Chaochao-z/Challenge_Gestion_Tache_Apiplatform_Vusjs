<?php

namespace App\State;

use App\Entity\User;
use App\Dto\UserVerifyEmailDto;
use ApiPlatform\Metadata\Operation;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\State\ProcessorInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class UserVerifyEmailProcessor implements ProcessorInterface
{

    public function __construct(private EntityManagerInterface $em){}

    public function process($data, Operation $operation, array $uriVariables = [], array $context = []): ?User
    {
        if (!$data instanceof UserVerifyEmailDto) {
            return null;
        }
        $user = $this->em->getRepository(User::class)->findOneBy(['Token' => $data->token]);
        if(!$user){
            throw new NotFoundHttpException('User not found or token already used');
        }
        $user->setIsVerified(true);
        $user->setToken(null);
        $this->em->flush();
        return $user;
    }
}
