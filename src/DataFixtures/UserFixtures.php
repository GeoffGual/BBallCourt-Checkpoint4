<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('test@gmail.com');
        $user->setUsername('Tony P');
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'testuser'
        ));
        $manager->persist($user);
        $manager->flush();

        $user = new User();
        $user->setEmail('test1@gmail.com');
        $user->setUsername('Michael jordan');
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'testuser1'
        ));
        $this->addReference('user_1', $user);
        $manager->persist($user);
        $manager->flush();
    }
}
