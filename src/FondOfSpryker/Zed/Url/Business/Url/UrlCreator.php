<?php

namespace FondOfSpryker\Zed\Url\Business\Url;

use Generated\Shared\Transfer\UrlTransfer;
use Spryker\Zed\Url\Business\Url\UrlCreator as SprykerUrlCreator;

class UrlCreator extends SprykerUrlCreator implements UrlCreatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\UrlTransfer $urlTransfer
     *
     * @return \Generated\Shared\Transfer\UrlTransfer
     */
    protected function persistUrlEntity(UrlTransfer $urlTransfer)
    {
        $urlTransfer
            ->requireUrl()
            ->requireFkLocale()
            ->requireFkStore();

        $urlEntity = $this->urlQueryContainer->queryUrl($urlTransfer->getUrl())
            ->filterByFkStore($urlTransfer->getFkStore())
            ->filterByFkLocale($urlTransfer->getFkLocale())
            ->findOneOrCreate();

        $id = $urlEntity->getIdUrl();
        $urlEntity->fromArray($urlTransfer->modifiedToArray());
        $urlEntity->setIdUrl($id);
        $urlEntity->save();

        return $urlTransfer->fromArray($urlEntity->toArray(), true);
    }
}
