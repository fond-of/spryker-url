<?php

namespace FondOfSpryker\Zed\Url\Business\Url;

use Generated\Shared\Transfer\UrlTransfer;
use InvalidArgumentException;
use Orm\Zed\Url\Persistence\SpyUrlQuery;
use Spryker\Zed\Kernel\Persistence\QueryContainer\QueryContainerInterface;
use Spryker\Zed\Store\Business\StoreFacadeInterface;
use Spryker\Zed\Url\Business\Url\UrlReader as SprykerUrlReader;
use Spryker\Zed\Url\Persistence\UrlQueryContainerInterface;

class UrlReader extends SprykerUrlReader implements UrlReaderInterface
{
    /**
     * @var \Spryker\Zed\Url\Persistence\UrlQueryContainerInterface
     */
    protected $queryContainer;

    /**
     * @var \Spryker\Zed\Store\Business\StoreFacadeInterface
     */
    protected $storeFacade;

    /**
     * @param \Spryker\Zed\Kernel\Persistence\QueryContainer\QueryContainerInterface $queryContainer
     * @param \Spryker\Zed\Store\Business\StoreFacadeInterface $storeFacade
     */
    public function __construct(UrlQueryContainerInterface $queryContainer, StoreFacadeInterface $storeFacade)
    {
        parent::__construct($queryContainer);
        $this->storeFacade = $storeFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\UrlTransfer $urlTransfer
     * @param bool $ignoreUrlRedirects
     *
     * @throws
     *
     * @return \Orm\Zed\Url\Persistence\SpyUrlQuerys
     */
    protected function queryUrlEntity(UrlTransfer $urlTransfer, $ignoreUrlRedirects = false)
    {
        $fkStore = $this->storeFacade->getCurrentStore()->getIdStore();

        return parent::queryUrlEntity($urlTransfer, $ignoreUrlRedirects)->filterByFkStore($fkStore);
    }
}
