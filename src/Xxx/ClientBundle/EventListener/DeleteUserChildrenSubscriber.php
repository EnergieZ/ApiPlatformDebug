<?php

namespace Xxx\ClientBundle\EventListener;

use ApiPlatform\Core\EventListener\EventPriorities;
use Doctrine\ORM\EntityManagerInterface;
use Xxx\ClientBundle\Entity\User;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final class DeleteUserChildrenSubscriber implements EventSubscriberInterface
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['deleteUserChildren', EventPriorities::POST_WRITE],
        ];
    }

    public function deleteUserChildren(GetResponseForControllerResultEvent $event)
    {
        $object = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if (Request::METHOD_PUT === $method && $object instanceof User) {
            $content = $event->getRequest()->getContent();
            $content = json_decode($content, true);
            $this->em->refresh($object); //grab from db
            $doneChild = array();
            foreach($object->getChildren() as $child){
                $delete = true;
                foreach ($content['children'] as $givenChild){
                    if(isset($givenChild['firstName']) and $givenChild['firstName'] == $child->getFirstName() and !in_array($givenChild['firstName'], $doneChild)){
                        $doneChild[] = $givenChild['firstName'];
                        $delete = false;
                    }
                }
                if($delete){
                    $this->em->remove($child);
                }
            }
            $this->em->flush();
        }
        return;
    }
}