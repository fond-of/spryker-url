<?php

namespace FondOfSpryker\Zed\Url\Business;

use FondOfSpryker\Zed\Url\Business\Redirect\Observer\UrlUpdateObserver;
use Spryker\Zed\Url\Business\UrlBusinessFactory as SprykerUrlBusinessFactory;

class UrlBusinessFactory extends SprykerUrlBusinessFactory
{
    /**
     * @return \Spryker\Zed\Url\Business\Url\UrlUpdaterAfterSaveObserverInterface
     */
    protected function createUrlUpdateObserver()
    {
        return new UrlUpdateObserver($this->createUrlRedirectCreator());
    }
}
