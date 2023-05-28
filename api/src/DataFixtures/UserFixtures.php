<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $pwd=null;
    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $user = new User();
        $this->pwd=$userPasswordHasher->hashPassword(
            $user,
            "Zhouchao199");
    }

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $user = new User();
        $user->setUsername("Chaochao");
        $user->setMail("chaochao.zhou@hotmail.com");
        $user->setPassword($this->pwd);
        $user->setRoles(["ROLE_ADMIN"]);
        $manager->persist($user);
        $manager->flush();
    }
}
