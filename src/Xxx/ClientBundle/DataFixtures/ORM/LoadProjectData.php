<?php

namespace Xxx\ClientBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Xxx\ClientBundle\Entity\Project;
use Xxx\ClientBundle\Entity\Ticket;

class LoadProjectData extends AbstractFixture implements DependentFixtureInterface
{
    public function getDependencies()
    {
        return array(
            LoadUserData::class
        );
    }

    public function load(ObjectManager $manager)
    {
        $user = $manager->getRepository('XxxClientBundle:User')->findOneBy(array('email'=>'user@user.com'));
        $admin = $manager->getRepository('XxxClientBundle:User')->findOneBy(array('email'=>'admin@admin.com'));

        $project = new Project();
        $project->setDateAdd(new \DateTime());
        $project->setName('Mon premier projet');
        $project->setCustomer($user);
        $project->setEAteamUser($admin);
        $manager->persist($project);

        $project2 = new Project();
        $project2->setDateAdd(new \DateTime());
        $project2->setName('Mon 2éme projet');
        $project2->setCustomer($user);
        $project2->setEAteamUser($admin);
        $manager->persist($project2);

        $project3 = new Project();
        $project3->setDateAdd(new \DateTime());
        $project3->setName('Mon 3éme projet');
        $project3->setCustomer($user);
        $project3->setEAteamUser($admin);
        $manager->persist($project3);

        $ticket = new Ticket();
        $ticket->setDescription('La description du ticket');
        $ticket->setTitle('Ticket #1');
        $ticket->setProject($project);
        $ticket->setDateAdd(new \DateTime());
        $manager->persist($ticket);

        $ticket2 = new Ticket();
        $ticket2->setDescription('Une super belle description balaabidu');
        $ticket2->setTitle('Ticket #2 houaa !');
        $ticket2->setProject($project);
        $ticket2->setDateAdd(new \DateTime());
        $manager->persist($ticket2);

        $manager->flush();
    }
}