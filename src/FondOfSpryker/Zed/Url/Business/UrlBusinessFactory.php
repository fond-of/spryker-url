<?php

namespace FondOfSpryker\Zed\Url\Business;

use FondOfSpryker\Zed\Url\Business\Redirect\Observer\UrlUpdateObserver;
use FondOfSpryker\Zed\Url\Business\Url\UrlCreator;
use FondOfSpryker\Zed\Url\Business\Url\UrlReader;
use FondOfSpryker\Zed\Url\Business\Url\UrlReaderInterface;
use FondOfSpryker\Zed\Url\Dependency\Facade\UrlToStoreFacadeInterface;
use FondOfSpryker\Zed\Url\UrlDependencyProvider;
use Spryker\Zed\Url\Business\UrlBusinessFactory as SprykerUrlBusinessFactory;

/**
 * @method \Spryker\Zed\Url\Persistence\UrlQueryContainerInterface getQueryContainer()
 * @method \Spryker\Zed\Url\UrlConfig getConfig()
 * @method \Spryker\Zed\Url\Persistence\UrlRepositoryInterface getRepository()
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
            $this->getRepository(),
            $this->getStoreFacade(),
        );
    }

    /**
     * @return \FondOfSpryker\Zed\Url\Business\Url\UrlCreatorInterface
     */
    public function createUrlCreator()
    {
        $urlCreator = new UrlCreator($this->getQueryContainer(), $this->createUrlReader(), $this->createUrlActivator());

        $this->attachUrlCreatorObservers($urlCreator);

        return $urlCreator;
    }

    /**
     * @return \FondOfSpryker\Zed\Url\Dependency\Facade\UrlToStoreFacadeInterface
     */
    protected function getStoreFacade(): UrlToStoreFacadeInterface
    {
        return $this->getProvidedDependency(UrlDependencyProvider::FACADE_STORE);
    }
}
