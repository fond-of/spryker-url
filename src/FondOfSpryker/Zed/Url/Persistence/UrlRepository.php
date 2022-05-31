<?php

namespace FondOfSpryker\Zed\Url\Persistence;

use Generated\Shared\Transfer\UrlTransfer;
use Orm\Zed\Url\Persistence\SpyUrlQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Spryker\Zed\Url\Persistence\UrlRepository as SprykerUrlRepository;

/**
 * @method \Spryker\Zed\Url\Persistence\UrlPersistenceFactory getFactory()
 */
class UrlRepository extends SprykerUrlRepository implements UrlRepositoryInterface
{
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
            //phpcs wont let me override it on class @method
            /** @var \FondOfSpryker\Zed\Url\Persistence\UrlPersistenceFactory $factory */
            $factory = $this->getFactory();
            $fkStore = $factory->getStoreFacade()->getCurrentStore()->getIdStore();

            return $urlQuery->filterByUrl($urlTransfer->getUrl())->filterByFkStore($fkStore);
        }

        return $urlQuery->filterByIdUrl($urlTransfer->getIdUrl());
    }
}
