<?php

namespace Mayeco\EasyAnnotationBundle\Configuration;

use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;

interface ExecutableAnnotationViewInterface
{

    public function executeOnView(GetResponseForControllerResultEvent $event);

}