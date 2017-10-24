<?php

namespace Xxx\ClientBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Xxx\ClientBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class LoadUserData implements FixtureInterface, ContainerAwareInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('user@user.com');
        $user->setFirstName('Julien');
        $user->setLastName('Pillias');
        $user->addRole('ROLE_USER');
        $plainPassword = 'aaaa';
        $passwordEncoder = $this->container->get('security.encoder_factory')->getEncoder($user);
        $user->setPassword($passwordEncoder->encodePassword($plainPassword,null));
        $manager->persist($user);

        $user2 = new User();
        $user2->setEmail('admin@admin.com');
        $user2->setFirstName('Julien');
        $user2->setLastName('Pillias');
        $user2->addRole('ROLE_ADMIN');
        $user2->addRole('ROLE_EMPLOYE');
        $user2->addRole('ROLE_USER');
        $plainPassword = 'aaaa';
        $passwordEncoder = $this->container->get('security.encoder_factory')->getEncoder($user2);
        $user2->setPassword($passwordEncoder->encodePassword($plainPassword,null));
        $manager->persist($user2);

        $user3 = new User();
        $user3->setEmail('employe@employe.com');
        $user3->setFirstName('Thierry');
        $user3->setLastName('Dupond');
        $user3->addRole('ROLE_EMPLOYE');
        $user3->addRole('ROLE_USER');
        $plainPassword = 'aaaa';
        $passwordEncoder = $this->container->get('security.encoder_factory')->getEncoder($user3);
        $user3->setPassword($passwordEncoder->encodePassword($plainPassword,null));
        $manager->persist($user3);

        $user4 = new User();
        $user4->setEmail('SITE_OPERATOR@SITE_OPERATOR.com');
        $user4->setFirstName('Thierry');
        $user4->setLastName('Dupond');
        $user4->addRole('ROLE_SITE_OPERATOR');
        $user4->addRole('ROLE_USER');
        $plainPassword = 'aaaa';
        $passwordEncoder = $this->container->get('security.encoder_factory')->getEncoder($user4);
        $user4->setPassword($passwordEncoder->encodePassword($plainPassword,null));
        $manager->persist($user4);

        $manager->flush();
    }
}