<?php

namespace ZfcUser\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use ZfcUser\Controller\UserController;

class ControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $sm)
    {
        // get di
        $di         = $sm->get('Di');

        // This was what I tried before.
        $userService  = $sm->get('zfcuser_user_service');
        $loginEvents  = $sm->get('EventManager');
        $loginForm    = $sm->get('ZfcUser\Form\Login');
        $loginForm->setEventManager($loginEvents);
        $registerForm = $sm->get('ZfcUser\Form\Register');

        $controller = new UserController();
        $controller->setUserService($userService);
        $controller->setLoginForm($loginForm);
        $controller->setServiceLocator($sm);
        $controller->setBroker($sm->get('ControllerPluginBroker'));
        $controller->setRegisterForm($registerForm);
        return $controller;
    }
}
