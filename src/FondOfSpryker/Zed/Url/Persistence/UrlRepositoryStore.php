<?php

namespace FondOfSpryker\Zed\Url\Persistence;

use Generated\Shared\Transfer\UrlTransfer;
use Orm\Zed\Url\Persistence\SpyUrlQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;
use Spryker\Zed\Store\Business\StoreFacadeInterface;
use Spryker\Zed\Url\Persistence\UrlRepositoryInterface;

class UrlRepositoryStore extends AbstractRepository implements UrlRepositoryInterface
{
    /**
     * @var \Spryker\Zed\Url\Persistence\UrlRepositoryInterface
     */
    private $repository;

    /**
     * @var \Spryker\Zed\Store\Business\StoreFacadeInterface
     */
    private $storeFacade;

    /**
     * @param \Spryker\Zed\Url\Persistence\UrlRepositoryInterface $repository
     * @param \Spryker\Zed\Store\Business\StoreFacadeInterface $storeFacade
     */
    public function __construct(
        UrlRepositoryInterface $repository,
        StoreFacadeInterface $storeFacade
    )
    {
        $this->repository = $repository;
        $this->storeFacade = $storeFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\UrlTransfer $urlTransfer
     *
     * @return \Generated\Shared\Transfer\UrlTransfer|null
     */
    public function findUrlCaseInsensitive(UrlTransfer $urlTransfer): ?UrlTransfer
    {
        $urlEntity = $this->prepareUrlCaseInsensitiveQuery($urlTransfer)->findOne();

        if ($urlEntity === null) {
            return null;
        }

        return (new UrlTransfer())->fromArray($urlEntity->toArray());
    }

    /**
     * @param \Generated\Shared\Transfer\UrlTransfer $urlTransfer
     * @param bool $ignoreRedirects
     *
     * @return bool
     */
    public function hasUrlCaseInsensitive(UrlTransfer $urlTransfer, bool $ignoreRedirects): bool
    {
        $urlQuery = $this->prepareUrlCaseInsensitiveQuery($urlTransfer);

        if ($ignoreRedirects) {
            $urlQuery->filterByFkResourceRedirect(null, Criteria::ISNULL);
        }

        return $urlQuery->exists();
    }

    /**
     * @param \Generated\Shared\Transfer\UrlTransfer $urlTransfer
     *
     * @return \Orm\Zed\Url\Persistence\SpyUrlQuery
     */
    protected function prepareUrlCaseInsensitiveQuery(UrlTransfer $urlTransfer): SpyUrlQuery
    {
        $urlQuery = $this->getFactory()
            ->createUrlQuery()
            ->setIgnoreCase(true);

        if ($urlTransfer->getUrl() !== null) {
            $fkStore = $this->storeFacade->getCurrentStore()->getIdStore();
            return $urlQuery->filterByUrl($urlTransfer->getUrl())->filterByFkStore($fkStore);
        }

        return $urlQuery->filterByIdUrl($urlTransfer->getIdUrl());
    }
}
