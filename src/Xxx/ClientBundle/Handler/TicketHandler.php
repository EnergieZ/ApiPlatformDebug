<?php

namespace Xxx\ClientBundle\Handler;

use Doctrine\Common\Persistence\ObjectManager;

class TicketHandler
{
    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    public function getAll()
    {
        return $this->objectManager->getRepository('XxxClientBundle:Ticket')->findAll();
    }

    public function get($id)
    {
        return $this->objectManager->getRepository('XxxClientBundle:Ticket')->find($id);
    }

    public function getByUser($user, $returnQueryBuilder = false)
    {
        return $this->objectManager->getRepository('XxxClientBundle:Ticket')->getByUser($user, $returnQueryBuilder);
    }
}