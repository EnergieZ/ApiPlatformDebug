<?php

namespace Xxx\ClientBundle\Handler;

use Doctrine\Common\Persistence\ObjectManager;

class FileHandler
{
    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    public function get($id)
    {
        return $this->objectManager->getRepository('XxxClientBundle:File')->find($id);
    }
}