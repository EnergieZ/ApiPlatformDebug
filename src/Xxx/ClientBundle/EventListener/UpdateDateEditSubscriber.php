<?php

namespace Xxx\ClientBundle\EventListener;

use ApiPlatform\Core\EventListener\EventPriorities;
use Doctrine\ORM\EntityManagerInterface;
use Xxx\ClientBundle\Entity\Configuration;
use Xxx\ClientBundle\Entity\Ticket;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final class UpdateDateEditSubscriber implements EventSubscriberInterface
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['setDateEdit', EventPriorities::POST_WRITE],
        ];
    }

    public function setDateEdit(GetResponseForControllerResultEvent $event)
    {
        $object = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if (
            Request::METHOD_PUT === $method
            && (
                $object instanceof Ticket
                || $object instanceof Configuration
            )
        ) {
            $object->setDateEdit(new \DateTime());
            $this->em->persist($object);
            $this->em->flush();
        }
        return;
    }
}