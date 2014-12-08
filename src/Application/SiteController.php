<?php
namespace CBase\Ctream\Application;

use Silex\Api\ControllerProviderInterface;
use Silex\ControllerCollection;

class SiteController implements ControllerProviderInterface {

    /**
     * Returns routes to connect to the given application.
     *
     * @param \Silex\Application $app An Application instance
     *
     * @return ControllerCollection A ControllerCollection instance
     */
    public function connect(\Silex\Application $app) {
        $controllers = $app['controllers_factory'];

        $controllers->get('/', function(\Silex\Application $app) {
            return 'Hello c-base';
        });

        return $controllers;
    }
}