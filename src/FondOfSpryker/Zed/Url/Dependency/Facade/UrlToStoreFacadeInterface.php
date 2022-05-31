<?php

namespace FondOfSpryker\Zed\Url\Dependency\Facade;

use Generated\Shared\Transfer\StoreTransfer;

interface UrlToStoreFacadeInterface
{
    /**
     * @return \Generated\Shared\Transfer\StoreTransfer
     */
    public function getCurrentStore(): StoreTransfer;
}
