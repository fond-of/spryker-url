<?php

namespace FondOfSpryker\Zed\Url\Business\Url;

use Spryker\Zed\Kernel\Persistence\QueryContainer\QueryContainerInterface;
use Spryker\Zed\Store\Business\StoreFacadeInterface;
use Spryker\Zed\Url\Business\Url\UrlReaderInterface as SprykerUrlReaderInterface;
use Spryker\Zed\Url\Persistence\UrlQueryContainerInterface;
use Spryker\Zed\Url\Persistence\UrlRepositoryInterface;

interface UrlReaderInterface extends SprykerUrlReaderInterface
{
    /**
     * UrlReader constructor.
     * @param  \Spryker\Zed\Url\Persistence\UrlQueryContainerInterface  $queryContainer
     * @param  \Spryker\Zed\Url\Persistence\UrlRepositoryInterface  $urlRepository
     * @param  \Spryker\Zed\Store\Business\StoreFacadeInterface  $storeFacade
     */
    public function __construct(UrlQueryContainerInterface $queryContainer, UrlRepositoryInterface $urlRepository, StoreFacadeInterface $storeFacade);
}
