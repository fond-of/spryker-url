<?php

namespace FondOfSpryker\Zed\Url\Persistence;

use FondOfSpryker\Zed\Url\Dependency\Facade\UrlToStoreFacadeInterface;
use FondOfSpryker\Zed\Url\UrlDependencyProvider;
use Spryker\Zed\Url\Persistence\UrlPersistenceFactory as SprykerUrlPersistenceFactory;

/**
 * @method \Spryker\Zed\Url\UrlConfig getConfig()
 * @method \Spryker\Zed\Url\Persistence\UrlQueryContainerInterface getQueryContainer()
 * @method \Spryker\Zed\Url\Persistence\UrlRepositoryInterface getRepository()
 */
class UrlPersistenceFactory extends SprykerUrlPersistenceFactory
{
    /**
     * @return \FondOfSpryker\Zed\Url\Dependency\Facade\UrlToStoreFacadeInterface
     */
    public function getStoreFacade(): UrlToStoreFacadeInterface
    {
        return $this->getProvidedDependency(UrlDependencyProvider::FACADE_STORE);
    }
}
