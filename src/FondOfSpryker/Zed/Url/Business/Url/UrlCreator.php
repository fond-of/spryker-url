<?php

namespace FondOfSpryker\Zed\Url\Business\Url;

use Spryker\Zed\Url\Business\Url\UrlCreator as SprykerUrlCreator;
use Generated\Shared\Transfer\UrlTransfer;

class UrlCreator extends SprykerUrlCreator implements UrlCreatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\UrlTransfer $urlTransfer
     *
     * @return \Generated\Shared\Transfer\UrlTransfer
     */
    protected function persistUrlEntity(UrlTransfer $urlTransfer)
    {
        $urlTransfer->requireUrl();
        $urlTransfer->requireFkLocale();
        $urlTransfer->requireFkStore();
        $urlEntity = $this->urlQueryContainer->queryUrl($urlTransfer->getUrl())
            ->filterByFkStore($urlTransfer->getFkStore())
            ->filterByFkLocale($urlTransfer->getFkLocale())
            ->findOneOrCreate();

        $id = $urlEntity->getIdUrl();
        $urlEntity->fromArray($urlTransfer->modifiedToArray());
        $urlEntity->setIdUrl($id);
        $urlEntity->save();

        $urlTransfer->fromArray($urlEntity->toArray(), true);

        return $urlTransfer;
    }
}
