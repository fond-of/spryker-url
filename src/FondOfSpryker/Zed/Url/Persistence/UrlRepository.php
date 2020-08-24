<?php

namespace FondOfSpryker\Zed\Url\Persistence;

use Generated\Shared\Transfer\UrlTransfer;
use Orm\Zed\Url\Persistence\SpyUrlQuery;
use Spryker\Zed\Url\Persistence\UrlRepository as SpryklerUrlRepository;

class UrlRepository extends SpryklerUrlRepository
{
    protected function prepareUrlCaseInsensitiveQuery(UrlTransfer $urlTransfer): SpyUrlQuery
    {
        $urlQuery = $this->getFactory()
            ->createUrlQuery()
            ->setIgnoreCase(true);

        if ($urlTransfer->getUrl() !== null) {
            return $urlQuery->filterByUrl($urlTransfer->getUrl())->filterByFkStore($urlTransfer->getFkStore());
        }

        return $urlQuery->filterByIdUrl($urlTransfer->getIdUrl());
    }

}
