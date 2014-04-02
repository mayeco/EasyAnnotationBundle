<?php

namespace Mayeco\EasyAnnotationBundle\EventListener;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

use Mayeco\EasyAnnotationBundle\Configuration\ExecutableAnnotationControllerInterface;
use Mayeco\EasyAnnotationBundle\Configuration\ExecutableAnnotationViewInterface;

class AnnotationListener implements EventSubscriberInterface
{

    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function onKernelController(FilterControllerEvent $event)
    {
        if (!is_array($controller = $event->getController()))
        {
            return;
        }

        foreach($event->getRequest()->attributes->all() as $atribute)
        {
            if(is_array($atribute))
            {
                foreach($atribute as $atribute_array)
                {

                    if($atribute_array instanceof ContainerAwareInterface){
                        $atribute_array->setContainer($this->container);
                    }

                    if($atribute_array instanceof ExecutableAnnotationControllerInterface){
                        $atribute_array->executeOnController($event);
                    }
                }
            }
            else
            {
                if($atribute instanceof ContainerAwareInterface){
                    $atribute->setContainer($this->container);
                }

                if($atribute instanceof ExecutableAnnotationControllerInterface){
                    $atribute->executeOnController($event);
                }
            }
        }
    }

    public function onKernelView(GetResponseForControllerResultEvent $event)
    {
        foreach($event->getRequest()->attributes->all() as $atribute)
        {
            if(is_array($atribute))
            {
                foreach($atribute as $atribute_array)
                {

                    if($atribute_array instanceof ContainerAwareInterface){
                        $atribute_array->setContainer($this->container);
                    }

                    if($atribute_array instanceof ExecutableAnnotationControllerInterface){
                        $atribute_array->executeOnController($event);
                    }
                }
            }
            else
            {
                if($atribute instanceof ContainerAwareInterface){
                    $atribute->setContainer($this->container);
                }

                if($atribute instanceof ExecutableAnnotationViewInterface){
                    $atribute->executeOnView($event);
                }
            }

        }
    }

    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::CONTROLLER => array('onKernelController', -100),
            KernelEvents::VIEW => 'onKernelView',
        );
    }
}
