<?php

namespace FondOfSpryker\Yves\Url;

use FondOfSpryker\Yves\Url\Model\UrlPrefixHandler;
use FondOfSpryker\Yves\Url\Model\UrlPrefixHandlerInterface;
use Spryker\Yves\Url\UrlFactory as SprykerUrlFactory;

class UrlFactory extends SprykerUrlFactory
{
    /**
     * @return \FondOfSpryker\Yves\Url\Model\UrlPrefixHandlerInterface
     */
    public function createUrlPrefixHandler(): UrlPrefixHandlerInterface
    {
        return new UrlPrefixHandler();
    }
}
