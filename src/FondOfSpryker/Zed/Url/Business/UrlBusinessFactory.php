<?php

namespace FondOfSpryker\Zed\Url\Business;

use FondOfSpryker\Zed\Url\Business\Redirect\Observer\UrlUpdateObserver;
use FondOfSpryker\Zed\Url\Business\Url\UrlReader;
use FondOfSpryker\Zed\Url\Business\Url\UrlReaderInterface;
use FondOfSpryker\Zed\Url\UrlDependencyProvider;
use Spryker\Zed\Store\Business\StoreFacadeInterface;
use Spryker\Zed\Url\Business\UrlBusinessFactory as SprykerUrlBusinessFactory;

/**
 * @method \Spryker\Zed\Url\Persistence\UrlQueryContainerInterface getQueryContainer()
 * @method \Spryker\Zed\Url\UrlConfig getConfig()
 */
class UrlBusinessFactory extends SprykerUrlBusinessFactory
{
    /**
     * @return \Spryker\Zed\Url\Business\Url\UrlUpdaterAfterSaveObserverInterface
     */
    protected function createUrlUpdateObserver()
    {
        return new UrlUpdateObserver($this->createUrlRedirectCreator());
    }

    /**
     * @return \FondOfSpryker\Zed\Url\Business\Url\UrlReaderInterface
     */
    public function createUrlReader(): UrlReaderInterface
    {
        return new UrlReader(
            $this->getQueryContainer(),
            $this->getStoreFacade()
        );
    }

    /**
     * @throws
     *
     * @return \Spryker\Zed\Store\Business\StoreFacadeInterface
     */
    protected function getStoreFacade(): StoreFacadeInterface
    {
        return $this->getProvidedDependency(UrlDependencyProvider::FACADE_STORE);
    }
}
