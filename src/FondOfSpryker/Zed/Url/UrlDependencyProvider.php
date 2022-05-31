<?php

namespace FondOfSpryker\Zed\Url;

use FondOfSpryker\Zed\Url\Dependency\Facade\UrlToStoreFacadeBridge;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Url\UrlDependencyProvider as SprykerUrlDependencyProvider;

/**
 * @method \Spryker\Zed\Url\UrlConfig getConfig()
 */
class UrlDependencyProvider extends SprykerUrlDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_STORE = 'FACADE_STORE';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);
        $container = $this->addStoreFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = parent::providePersistenceLayerDependencies($container);
        $container = $this->addStoreFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addStoreFacade(Container $container): Container
    {
        $container[static::FACADE_STORE] = function (Container $container) {
            return new UrlToStoreFacadeBridge($container->getLocator()->store()->facade());
        };

        return $container;
    }
}
