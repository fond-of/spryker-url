<?php

namespace FondOfSpryker\Yves\Url\Plugin\Twig;

use Spryker\Service\Container\ContainerInterface;
use Spryker\Shared\Kernel\Store;
use Spryker\Shared\TwigExtension\Dependency\Plugin\TwigPluginInterface;
use Spryker\Yves\Kernel\AbstractPlugin;
use Twig\Environment;

/**
 * Class UrlPathPrefixTwigPlugin
 * @method \FondOfSpryker\Yves\Url\UrlFactory getFactory()
 */
class UrlPathPrefixTwigPlugin extends AbstractPlugin implements TwigPluginInterface
{
    /**
     * @param  \Twig\Environment  $twig
     * @param  \Spryker\Service\Container\ContainerInterface  $container
     *
     * @return \Twig\Environment
     */
    public function extend(Environment $twig, ContainerInterface $container): Environment
    {
        $twig->addGlobal('url_path_prefix', $this->getFactory()->createUrlPrefixHandler()->getUrlPathPrefix($this->getLocale()));
        return $twig;
    }
}
