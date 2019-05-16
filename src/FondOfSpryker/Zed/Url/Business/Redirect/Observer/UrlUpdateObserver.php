<?php

namespace FondOfSpryker\Zed\Url\Business\Redirect\Observer;

use Generated\Shared\Transfer\UrlTransfer;
use Spryker\Zed\Url\Business\Redirect\Observer\UrlUpdateObserver as SprykerUrlUpdateObserver;

class UrlUpdateObserver extends SprykerUrlUpdateObserver
{
    /**
     * @param \Generated\Shared\Transfer\UrlTransfer $originalUrlTransfer
     *
     * @return \Generated\Shared\Transfer\UrlTransfer
     */
    protected function createUrlTransfer(UrlTransfer $originalUrlTransfer): UrlTransfer
    {
        $sourceUrlTransfer = new UrlTransfer();
        $sourceUrlTransfer
            ->setUrl($originalUrlTransfer->getUrl())
            ->setFkLocale($originalUrlTransfer->getFkLocale())
            ->setFkStore($originalUrlTransfer->getFkStore());

        return $sourceUrlTransfer;
    }
}
