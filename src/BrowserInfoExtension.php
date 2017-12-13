<?php

namespace Bolt\Extension\Jadwigo\BrowserInfo;

use Bolt\Extension\SimpleExtension;
use Silex\Application;
use Silex\ControllerCollection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use UAParser\Parser;

/**
 * BrowserInfo extension class.
 *
 * @author Lodewijk Evers <lodewijk@twokings.nl>
 */
class BrowserInfoExtension extends SimpleExtension
{

    private $app;
    private $browser;
  
    public function __construct()
    {
        $this->app = $this->getContainer();
        // set variables that are needed later

        $ua = $_SERVER['HTTP_USER_AGENT'];

        $parser = Parser::create();
        $this->browser = $parser->parse($ua);

        //$this->browser = '';
    }

    /**
     * {@inheritdoc}
     */
    protected function registerFrontendRoutes(ControllerCollection $collection)
    {
        // All requests to /browser
        $collection->match('/browser', [$this, 'callbackBrowser']);
    }
    
    /**
     * @param Application $app
     * @param Request     $request
     *
     * @return Response
     */
    public function callbackBrowser(Application $app, Request $request)
    {
        if(!$this->app) {
            $this->app = $app;
        }
        //dump($this->app);
        return $this->app['twig']->render('@BrowserInfo/page.twig', [
            'browser' => $this->browser
        ]);
    }

    /**
     * {@inheritdoc}
     */
    protected function registerTwigFunctions()
    {
        return [
            'getbrowser' => 'browserGet',
            'browserinfo' => ['browserInfo', ['is_safe' => ['html']]]
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    protected function registerTwigPaths()
    {
        return [
            'templates' => ['namespace' => 'BrowserInfo']
        ];
    }

    /**
     * Return the browser data
     *
     * @return string
     */
    public function browserGet()
    {
        return $this->browser;
    }


    /**
     * Render and return the Twig file templates/info.twig
     *
     * @return string
     */
    public function browserInfo()
    {
        return $this->renderTemplate('@BrowserInfo/info.twig', [
            'browser' => $this->browser
        ]);
    }

    
}
