<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User;
        $user->setEmail("teamdeveloppeur.lywm@gmail.com");
        $user->setRoles(["ROLE_ADMIN"]);
        $user->setPassword('$2y$13$eJqGxhV6dyyjUYZFILWbRej5gFWtw/rV9bhWTV9qYWXVJqBbjPJ0q');

        $manager->persist($user);

        $manager->flush();
    }
}
