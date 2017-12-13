<?php

namespace Bolt\Extension\Jadwigo\BrowserInfo;

use Bolt\Extension\SimpleExtension;

/**
 * BrowserInfo extension class.
 *
 * @author Lodewijk Evers <lodewijk@twokings.nl>
 */
class BrowserInfoExtension extends SimpleExtension
{

    protected $browser;



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
            'templates'
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
        return $this->renderTemplate('info.twig', [
            'browser' => $this->browser
        ]);
    }

    
}
