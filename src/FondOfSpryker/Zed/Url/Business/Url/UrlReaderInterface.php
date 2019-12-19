<?php

namespace FondOfSpryker\Zed\Url\Business\Url;

use Spryker\Zed\Kernel\Persistence\QueryContainer\QueryContainerInterface;
use Spryker\Zed\Store\Business\StoreFacadeInterface;
use Spryker\Zed\Url\Business\Url\UrlReaderInterface as SprykerUrlReaderInterface;
use Spryker\Zed\Url\Persistence\UrlQueryContainerInterface;

interface UrlReaderInterface extends SprykerUrlReaderInterface
{
    /**
     * @param \Spryker\Zed\Url\Persistence\UrlQueryContainerInterface $queryContainer
     * @param \Spryker\Zed\Store\Business\StoreFacadeInterface $storeFacade
     */
    public function __construct(UrlQueryContainerInterface $queryContainer, StoreFacadeInterface $storeFacade);
}
