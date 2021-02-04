<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CommentFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $comment = new Comment();
        $comment->setUser($this->getReference('user_1'));
        $comment->setCourt($this->getReference('court_1'));
        $comment->setCreatedAt(new \DateTime('now'));
        $comment->setComment('My Paris fav\'s court');

        $manager->persist($comment);

        $manager->flush();
    }
    public function getDependencies()
    {
        return [CourtFixtures::class, UserFixtures::class];
    }
}
