<?php

namespace FondOfSpryker\Zed\Url\Business\Url;

use FondOfSpryker\Zed\Url\Dependency\Facade\UrlToStoreFacadeInterface;
use Spryker\Zed\Url\Business\Url\UrlReaderInterface as SprykerUrlReaderInterface;
use Spryker\Zed\Url\Persistence\UrlQueryContainerInterface;
use Spryker\Zed\Url\Persistence\UrlRepositoryInterface;

interface UrlReaderInterface extends SprykerUrlReaderInterface
{
    /**
     * @param \Spryker\Zed\Url\Persistence\UrlQueryContainerInterface $queryContainer
     * @param \Spryker\Zed\Url\Persistence\UrlRepositoryInterface $urlRepository
     * @param \FondOfSpryker\Zed\Url\Dependency\Facade\UrlToStoreFacadeInterface $storeFacade
     */
    public function __construct(UrlQueryContainerInterface $queryContainer, UrlRepositoryInterface $urlRepository, UrlToStoreFacadeInterface $storeFacade);
}
