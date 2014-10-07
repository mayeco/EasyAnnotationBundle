EasyAnnotationBundle
====================

## Prerequisites

SensioFrameworkExtraBundle

## Example


A sample anotation that validate only ajax request.


```php
<?php

namespace Acme\AcmeBundle\Configuration;

use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ConfigurationAnnotation;

use Mayeco\EasyAnnotationBundle\Configuration\ExecutableAnnotationControllerInterface;


/**
 * @Annotation
 */
class OnlyAjax extends ConfigurationAnnotation implements ExecutableAnnotationControllerInterface
{

    public function executeOnController(FilterControllerEvent $event)
    {
        if(!$event->getRequest()->isXmlHttpRequest()) {
            throw new AccessDeniedHttpException("No valid");
        }
    }

    public function getAliasName()
    {
        return 'onlyajax';
    }

    public function allowArray()
    {
        return false;
    }
}
```

Use in your controller


```php
...
use Acme\AcmeBundle\Configuration\OnlyAjax;
...

...
    /**
     *
     * OnlyAjax()
     */
    public function myAjaxFoo(Request $request)
    {

```
