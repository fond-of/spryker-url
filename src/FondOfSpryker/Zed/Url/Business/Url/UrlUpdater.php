<?php

namespace FondOfSpryker\Zed\Url\Business\Url;

use Generated\Shared\Transfer\UrlTransfer;
use Orm\Zed\Url\Persistence\SpyUrl;
use Spryker\Zed\Url\Business\Exception\MissingUrlException;
use Spryker\Zed\Url\Business\Url\AbstractUrlUpdaterSubject;
use Spryker\Zed\Url\Business\Url\UrlUpdater as SprykerUrlUpdater;
use Spryker\Zed\Url\Business\Url\UrlUpdaterInterface;

class UrlUpdater extends SprykerUrlUpdater
{
    /**
     * @param \Generated\Shared\Transfer\UrlTransfer $urlTransfer
     *
     * @return \Generated\Shared\Transfer\UrlTransfer
     */
    protected function executeUpdateUrlTransaction(UrlTransfer $urlTransfer): UrlTransfer
    {
        $urlEntity = $this->getUrlByIdAndStore($urlTransfer->getIdUrl(), $urlTransfer->getFkStore());
        $originalUrlTransfer = new UrlTransfer();
        $originalUrlTransfer->fromArray($urlEntity->toArray(), true);

        $urlEntity->fromArray($urlTransfer->modifiedToArray());

        if ($this->isUrlEntityChanged($urlEntity)) {
            $this->assertUrlDoesNotExist($urlTransfer);
        }

        $this->notifyBeforeSaveObservers($urlTransfer, $originalUrlTransfer);

        $urlEntity->save();
        $this->urlActivator->activateUrl($urlTransfer);

        $this->notifyAfterSaveObservers($urlTransfer, $originalUrlTransfer);

        return $urlTransfer;
    }

    /**
     * @param int $idUrl
     *
     * @throws \Spryker\Zed\Url\Business\Exception\MissingUrlException
     *
     * @return \Orm\Zed\Url\Persistence\SpyUrl
     */
    protected function getUrlByIdAndStore($idUrl, $idStore): SpyUrl
    {
        $urlEntity = $this->urlQueryContainer->queryUrlById($idUrl)->filterByFkStore($idStore)
            ->findOne();

        if (!$urlEntity) {
            throw new MissingUrlException(sprintf(
                'Tried to retrieve url with ID "%s", but it is missing',
                $idUrl
            ));
        }

        return $urlEntity;
    }
}
