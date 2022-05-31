<?php

namespace FondOfSpryker\Zed\Url\Business\Url;

use FondOfSpryker\Zed\Url\Dependency\Facade\UrlToStoreFacadeInterface;
use Generated\Shared\Transfer\UrlTransfer;
use Spryker\Zed\Url\Business\Url\UrlReader as SprykerUrlReader;
use Spryker\Zed\Url\Persistence\UrlQueryContainerInterface;
use Spryker\Zed\Url\Persistence\UrlRepositoryInterface;

class UrlReader extends SprykerUrlReader implements UrlReaderInterface
{
    /**
     * @var \Spryker\Zed\Url\Persistence\UrlQueryContainerInterface
     */
    protected $queryContainer;

    /**
     * @var \FondOfSpryker\Zed\Url\Dependency\Facade\UrlToStoreFacadeInterface
     */
    protected $storeFacade;

    /**
     * @param \Spryker\Zed\Url\Persistence\UrlQueryContainerInterface $queryContainer
     * @param \Spryker\Zed\Url\Persistence\UrlRepositoryInterface $urlRepository
     * @param \FondOfSpryker\Zed\Url\Dependency\Facade\UrlToStoreFacadeInterface $storeFacade
     */
    public function __construct(UrlQueryContainerInterface $queryContainer, UrlRepositoryInterface $urlRepository, UrlToStoreFacadeInterface $storeFacade)
    {
        parent::__construct($queryContainer, $urlRepository);
        $this->storeFacade = $storeFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\UrlTransfer $urlTransfer
     * @param bool $ignoreUrlRedirects
     *
     * @return \Orm\Zed\Url\Persistence\SpyUrlQuery
     */
    protected function queryUrlEntity(UrlTransfer $urlTransfer, $ignoreUrlRedirects = false)
    {
        $fkStore = $urlTransfer->getFkStore();
        if ($fkStore === null) {
            $fkStore = $this->storeFacade->getCurrentStore()->getIdStore();
        }

        return parent::queryUrlEntity($urlTransfer, $ignoreUrlRedirects)->filterByFkStore($fkStore);
    }
}
