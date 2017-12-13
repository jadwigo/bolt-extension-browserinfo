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
            'browserinfo' => ['browserInfoFunction', ['is_safe' => ['html']]]
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
     * Render and return the Twig file templates/browserinfo.twig
     *
     * @return string
     */
    public function browserInfoFunction()
    {
        return $this->renderTemplate('info.twig', [
            'browser' => $this->browser
        ]);
    }

    
}
