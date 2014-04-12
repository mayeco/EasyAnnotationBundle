<?php

namespace Mayeco\EasyAnnotationBundle\Configuration;

use Symfony\Component\HttpKernel\Event\FilterControllerEvent;

interface ExecutableAnnotationControllerInterface
{
    public function executeOnController(FilterControllerEvent $event);
}
