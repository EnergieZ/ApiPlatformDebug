<?php

namespace Xxx\ClientBundle\EventListener;

use ApiPlatform\Core\EventListener\EventPriorities;
use Doctrine\ORM\EntityManagerInterface;
use Xxx\ClientBundle\Entity\TicketAnswer;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final class TicketReadSubscriber implements EventSubscriberInterface
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['setNotReaded', EventPriorities::POST_WRITE],
        ];
    }

    public function setNotReaded(GetResponseForControllerResultEvent $event)
    {
        $tiketAnswer = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if (!$tiketAnswer instanceof TicketAnswer || Request::METHOD_POST !== $method || $tiketAnswer->getUser() == $tiketAnswer->getTicket()->getProject()->getCustomer()) {
            return;
        }

        $ticket = $tiketAnswer->getTicket();
        $ticket->setReaded(false);
        $this->em->persist($ticket);
        $this->em->flush();
    }
}